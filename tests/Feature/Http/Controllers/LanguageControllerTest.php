<?php

namespace Tests\Feature\Http\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    #[Test]
    public function czech_localization(): void
    {
        $this
            ->followingRedirects()
            ->get('language/cs');

        $this->assertEquals(app()->getLocale(), 'cs');
    }

    #[Test]
    public function english_localization(): void
    {
        $this
            ->followingRedirects()
            ->get('language/en');

        $this->assertEquals(app()->getLocale(), 'en');
    }
}
