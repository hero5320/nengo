<?php declare(strict_types=1);

namespace Hero5320\Nengo;

use PHPUnit\Framework\TestCase;

final class JapaneseNengoGeneratorTest extends TestCase
{
    public function testToWareki()
    {
        $wareki_case1 = [
            'wareki' => '令和',
            'year' => '03',
            'month' => '12',
            'day' => '12'
        ];
        $japanese_nengo_generator = new JapaneseNengoGenerator();
        $this->assertSame($japanese_nengo_generator->to_wareki('20211212'), $wareki_case1);
    }

    public function testToSeireki()
    {
        $seireki_case1 = [
            'year' => '2019',
            'month' => '12',
            'day' => '12'
        ];
        $japanese_nengo_generator = new JapaneseNengoGenerator();
        $this->assertSame($japanese_nengo_generator->to_seireki('令和元年12月12日'), $seireki_case1);
    }
}
