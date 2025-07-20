<?php

namespace SunlightExtend\Multilang;

use Sunlight\Database\Database as DB;
use Sunlight\Page\Page;
use Sunlight\Router;

class LanguageRoot
{
    const TYPE_IDT = 'multilang';

    /** @var int */
    private $id;
    /** @var Language */
    private $lang;
    /** @var string */
    private $title;
    /** @var string */
    private $heading;
    /** @var string */
    private $description;

    function __construct(int $id, Language $lang, string $title, string $heading, string $description)
    {
        $this->id = $id;
        $this->lang = $lang;
        $this->title = $title;
        $this->heading = $heading;
        $this->description = $description;
    }

    /**
     * @return array<string, self>
     */
    static function all(): array
    {
        static $cache = null;

        if ($cache !== null) {
            return $cache;
        }

        $query = DB::query(
            'SELECT id, slug, title, heading, description'
            . ' FROM ' . DB::table('page')
            . ' WHERE'
                .' type=' . Page::PLUGIN
                . ' AND type_idt=' . DB::val(self::TYPE_IDT)
                . ' AND node_level=0'
                . ' AND visible=1'
            . ' ORDER BY ord'
        );

        $roots = [];

        while ($row = DB::row($query)) {
            if (!Language::isValidCode($row['slug'])) {
                continue;
            }

            $roots[$row['slug']] = new self(
                $row['id'],
                Language::fromCode($row['slug']),
                $row['title'],
                $row['heading'],
                $row['description']
            );
        }

        return $cache = $roots;
    }

    static function getByLanguage(Language $lang): ?self
    {
        return self::all()[$lang->getCode()] ?? null;
    }
    
    static function getCurrent(): ?self
    {
        if (MultilangState::$lang === null) {
            return null;
        }
        
        return self::getByLanguage(MultilangState::$lang);
    }

    /**
     * @param array{slug: string, node_parent: int|null} $data
     * @return string[] validation errors
     */
    static function validate(array $data): array
    {
        $errors = [];

        if ($data['node_parent'] !== null) {
            $errors[] = _lang('multilang.err.root_used_as_subpage');
        } else {
            $lang = Language::tryFromCode($data['slug']);

            if ($lang === null) {
                $errors[] = _lang('multilang.err.invalid_lang_code');
            } elseif (LanguageService::getPluginForLanguage($lang) === null) {
                $errors[] = _lang('multilang.err.lang_unavailable');
            }
        }

        return $errors;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getHeading(): string
    {
        return $this->heading;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLang(): Language
    {
        return $this->lang;
    }

    /**
     * @return array{id: int, slug: string}|null
     */
    public function getIndex(): ?array
    {
        static $cache = null;
        static $loaded = false;

        if ($loaded) {
            return $cache;
        }

        $index = DB::queryRow(
            'SELECT id, slug'
            . ' FROM ' . DB::table('page')
            . ' WHERE'
                . ' node_parent=' . DB::val($this->id)
                . ' AND type!=' . Page::SEPARATOR
            . ' ORDER BY ord'
            . ' LIMIT 1'
        );

        if ($index === false) {
            $index = null;
        }

        return $cache = $index;
    }

    /**
     * Get URL to the language root itself
     *
     * @param array|null $options {@see Router}
     */
    public function getUrl(?array $options = null): string
    {
        return Router::page($this->id, $this->lang->getCode(), null, $options);
    }

    /**
     * Get URL of the language root's index page
     *
     * It will return the language root's URL if there is no index page.
     *
     * @param array|null $options {@see Router}
     */
    public function getIndexUrl(?array $options = null): string
    {
        $index = $this->getIndex();

        if ($index === null) {
            return $this->getUrl($options);
        }

        return Router::page($index['id'], $index['slug'], null, $options);
    }
}
