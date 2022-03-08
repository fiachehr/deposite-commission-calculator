<?php

namespace Tests\Feature;

use App\Helpers\CalculateHelper;
use function PHPUnit\Framework\assertEquals;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    /** @test */

    public function when_the_private_user_had_three_withdraw_in_a_week_more_than_one_thousand_euro_and_first_withdraw_was_more_than_1000()
    {


        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 1400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 650,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 1.2);
        assertEquals($result[1]['commission'], 1.95);
        assertEquals($result[2]['commission'], 0.3);
    }

    /** @test */

    public function when_the_private_user_had_three_withdraw_in_a_week_more_than_one_thousand_euro_and_in_second_withdraw_total_withdraw_became_more_than_1000()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 650,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0.15);
        assertEquals($result[2]['commission'], 0.3);
    }

    /** @test */

    public function when_the_private_user_had_three_withdraw_in_a_week_more_than_one_thousand_euro_and_in_third_withdraw_total_withdraw_became_more_than_1000()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 250,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0);
        assertEquals($result[2]['commission'], 0.15);
    }

    /** @test */

    public function when_the_private_user_had_three_withdraw_in_a_week_less_than_one_thousand()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 400,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 200,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0);
        assertEquals($result[2]['commission'], 0);
    }

    /** @test */

    public function when_the_private_user_had_more_than_three_withdraw_in_a_week_less_than_one_thousand()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 200,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0);
        assertEquals($result[2]['commission'], 0);
        assertEquals($result[3]['commission'], 0.3);
    }

    /** @test */

    public function when_the_private_user_had_less_than_three_withdraw_in_tow_weeks_less_than_one_thousand_weekly()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 200,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 250,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 300,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0);
        assertEquals($result[2]['commission'], 0);
        assertEquals($result[3]['commission'], 0);
        assertEquals($result[4]['commission'], 0);
        assertEquals($result[5]['commission'], 0);
    }

    /** @test */

    public function when_the_private_user_had_more_than_three_withdraw_in_tow_weeks_less_than_one_thousand_weekly()
    {

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 200,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 150,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 300,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-10',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 100,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-11',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 200,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals($result[0]['commission'], 0);
        assertEquals($result[1]['commission'], 0);
        assertEquals($result[2]['commission'], 0);
        assertEquals($result[3]['commission'], 0.3);
        assertEquals($result[4]['commission'], 0);
        assertEquals($result[5]['commission'], 0);
        assertEquals($result[6]['commission'], 0);
        assertEquals($result[7]['commission'], 0.6);
    }

    /** @test */

    public function when_the_private_user_had_three_withdraw_in_a_week_more_than_one_thousand_euro_and_first_withdraw_was_more_than_1000_in_different_currency()
    {

        // USD	1.129031
        // IRR	47701.574046
        // TRY	15.612274

        $path = public_path('currency-exchange-rates.json');
        $currencies = json_decode(file_get_contents($path), true)['rates'];

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 846.77325,
                'currency' => 'USD',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 14310472.2138,
                'currency' => 'IRR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'withdraw',
                'amount' => 2341.8411,
                'currency' => 'TRY',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals(round($result[0]['commission'] / $currencies[$result[0]['currency']], 2), 0);
        assertEquals(round($result[1]['commission'] / $currencies[$result[1]['currency']], 2), 0.15);
        assertEquals(round($result[2]['commission'] / $currencies[$result[2]['currency']], 2), 0.45);
    }

    /** @test */

    public function when_the_business_user_had_withdraw_in_different_currency()
    {

        // USD	1.129031
        // IRR	47701.574046
        // TRY	15.612274

        $path = public_path('currency-exchange-rates.json');
        $currencies = json_decode(file_get_contents($path), true)['rates'];

        $sampleData = [
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'business',
                'operation' => 'withdraw',
                'amount' => 846.77325,
                'currency' => 'USD',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'business',
                'operation' => 'withdraw',
                'amount' => 14310472.2138,
                'currency' => 'IRR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'business',
                'operation' => 'withdraw',
                'amount' => 2341.8411,
                'currency' => 'TRY',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '3',
                'type' => 'business',
                'operation' => 'withdraw',
                'amount' => 1250,
                'currency' => 'EUR',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals(round($result[0]['commission'] / $currencies[$result[0]['currency']], 2), 3.75);
        assertEquals(round($result[1]['commission'] / $currencies[$result[1]['currency']], 2), 1.5);
        assertEquals(round($result[2]['commission'] / $currencies[$result[2]['currency']], 2), 0.75);
        assertEquals(round($result[3]['commission'] / $currencies[$result[3]['currency']], 2), 6.25);
    }

    /** @test */

    public function when_the_user_had_deposit_in_different_currency()
    {

        // USD	1.129031
        // IRR	47701.574046
        // TRY	15.612274

        $path = public_path('currency-exchange-rates.json');
        $currencies = json_decode(file_get_contents($path), true)['rates'];

        $sampleData = [
            [
                'date' => '2022-03-03',
                'user_id' => '3',
                'type' => 'business',
                'operation' => 'deposit',
                'amount' => 1250,
                'currency' => 'EUR',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'deposit',
                'amount' => 846.77325,
                'currency' => 'USD',
            ],
            [
                'date' => '2022-03-01',
                'user_id' => '1',
                'type' => 'business',
                'operation' => 'deposit',
                'amount' => 14310472.2138,
                'currency' => 'IRR',
            ],
            [
                'date' => '2022-03-03',
                'user_id' => '1',
                'type' => 'private',
                'operation' => 'deposit',
                'amount' => 2341.8411,
                'currency' => 'TRY',
            ],
        ];

        $result = CalculateHelper::calculate($sampleData);
        assertEquals(round($result[0]['charge'] / $currencies[$result[0]['currency']],3), 0.375);
        assertEquals(round($result[1]['charge'] / $currencies[$result[1]['currency']], 3), 0.225);
        assertEquals(round($result[2]['charge'] / $currencies[$result[2]['currency']], 3), 0.09);
        assertEquals(round($result[3]['charge'] / $currencies[$result[3]['currency']], 3), 0.045);
    }
}
