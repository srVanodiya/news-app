<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticlesTableTest extends DuskTestCase
{
    /**
     * Test if the ArticlesTable component renders correctly.
     *
     * @return void
     */
    public function testArticlesTableRendersCorrectly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/path-to-your-component')
                    ->assertSee('Title')
                    ->assertSee('Source')
                    ->assertSee('Published At')
                    ->assertSee('Author')
                    ->assertSee('Description')
                    ->assertSee('Image')
                    ->assertSee('URL')
                    ->assertSee('Content')
                    ->screenshot('articles-table-renders-correctly'); // Take a screenshot for debugging
        });
    }

    /**
     * Test if the sorting functionality works.
     *
     * @return void
     */
    public function testSortingFunctionality()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/path-to-your-component')
                    ->select('select[name="sortBy"]', 'popularity')
                    ->pause(1000) // Wait for the articles to be sorted
                    ->assertSeeIn('tbody tr:first-child td:first-child', 'Expected First Article Title After Sorting')
                    ->screenshot('sorting-functionality'); // Take a screenshot for debugging
        });
    }
}