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

    //  /** @test */

    //  public function when_the_private_user_had_three_withdraw_in_a_week_more_than_one_thousand_euro_and_first_withdraw_was_more_than_1000_in_diffrent_currency()
    //  {

    //      $sampleData = [
    //          [
    //              'date' => '2022-03-01',
    //              'user_id' => '1',
    //              'type' => 'private',
    //              'operation' => 'withdraw',
    //              'amount' => 1400,
    //              'currency' => 'RRL',
    //          ],
    //          [
    //              'date' => '2022-03-01',
    //              'user_id' => '1',
    //              'type' => 'private',
    //              'operation' => 'withdraw',
    //              'amount' => 650,
    //              'currency' => 'EUR',
    //          ],
    //          [
    //              'date' => '2022-03-03',
    //              'user_id' => '1',
    //              'type' => 'private',
    //              'operation' => 'withdraw',
    //              'amount' => 100,
    //              'currency' => 'EUR',
    //          ],
    //      ];

    //      $result = CalculateHelper::calculate($sampleData);
    //      assertEquals($result[0]['commission'], 1.2);
    //      assertEquals($result[1]['commission'], 1.95);
    //      assertEquals($result[2]['commission'], 0.3);
    //  }

}
