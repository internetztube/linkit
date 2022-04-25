<?php
namespace fruitstudios\linkit\models;

use Craft;

use fruitstudios\linkit\Linkit;
use fruitstudios\linkit\base\Link;
use fruitstudios\linkit\validators\UrlValidator;

class Instagram extends Link
{
    // Private
    // =========================================================================

    private $_match = '/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_]+)/i';

    // Static
    // =========================================================================

    public static function group(): string
    {
        return Craft::t('linkit', 'Social');
    }

    public static function defaultLabel(): string
    {
        return Craft::t('linkit', 'Instagram');
    }

    public static function defaultPlaceholder(): string
    {
        return Craft::t('linkit', 'https://www.instagram.com/username');
    }

    // Public Methods
    // =========================================================================

    public function getUrl(): string
    {
        return (string) $this->value;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [
            ['value'],
            UrlValidator::class,
            'defaultScheme' => 'https',
            'message' => Craft::t('linkit', 'Please enter a valid url.')
        ];
        $rules[] = [
            ['value'],
            'match',
            'pattern' => $this->_match,
            'message' => Craft::t('linkit', 'Please enter a valid Instagram link.')
        ];
        return $rules;
    }
}
