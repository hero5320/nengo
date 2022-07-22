<?php
namespace Hero5320\Nengo;

class JapaneseNengoGenerator
{
    /**
    * 西暦→和暦変換
    *
    * @param string $time 変換対象となる日付(西暦)
    * @return array $result 変換後の日付(和暦)
    *
    */
    public function to_wareki($time = 'now')
    {
        // 元号一覧
        $era_list = [
        // 令和(2019年5月1日〜)
        [
            'jp' => '令和',
            'time' => '20190501'
        ],
        // 平成(1989年1月8日〜)
        [
            'jp' => '平成',
            'time' => '19890108'
        ],
        // 昭和(1926年12月25日〜)
        [
            'jp' => '昭和',
            'time' => '19261225'
        ],
        // 大正(1912年7月30日〜)
        [
            'jp' => '大正',
            'time' => '19120730'
        ],
        ];

        $dt = '';
        try {
            $dt = new DateTime($time);
        } catch (Exception $e) {
             // 日付型の指定でない
             echo $e->getMessage();
        }

            $result = [
              'wareki' => '',
              'year' => '',
              'month' => sprintf('%02d', $dt->format('m')),
              'day' => sprintf('%02d', $dt->format('d'))
            ];

            foreach ($era_list as $era) {
                $dt_era = new DateTime($era['time']);
                if ($dt->format('Ymd') >= $dt_era->format('Ymd')) {
                    $result['year'] = sprintf('%02d', $dt->format('Y') - $dt_era->format('Y') + 1);
                    $result['wareki'] = $era['jp'];
                    break;
                }
            }

            return $result;
    }
    
    /**
    * 和暦→西暦変換
    *
    * @param string $time 変換対象となる日付(和暦)
    * @return array $result 変換後の日付(西暦)
    *
    */
    public function to_seireki($time)
    {

        $time = str_replace('元年', '1年', mb_convert_kana($time, 'n'));

        if (preg_match('!^(大正|昭和|平成|令和)([0-9]+)年([0-9]+)月([0-9]+)日$!', $time, $matches)) {
            $era_name = $matches[1];
            $year = intval($matches[2]);
            $month = intval($matches[3]);
            $day = intval($matches[4]);

            if ($era_name === '大正') {
                $year += 1911;
            } elseif ($era_name === '昭和') {
                $year += 1925;
            } elseif ($era_name === '平成') {
                $year += 1988;
            } elseif ($era_name === '令和') {
                $year += 2018;
            }

            return [
                'year' => $year ,
                'month' => $month,
                'day' => $day
            ];
        }
        return [];
    }
}
