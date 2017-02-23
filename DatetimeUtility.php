<?php
/**
 * �����p�ėp�N���X
 */
class DatetimeUtility {
    /** �����p�ݒ�
     * ���t�̓E�B�L�y�f�B�A���Q�Ƃ��܂���
     * http://ja.wikipedia.org/wiki/%E5%85%83%E5%8F%B7%E4%B8%80%E8%A6%A7_%28%E6%97%A5%E6%9C%AC%29
     */
    private static $gengoList = [
        ['name' => '����', 'name_short' => 'H', 'timestamp' =>  600188400],  // 1989-01-08,
        ['name' => '���a', 'name_short' => 'S', 'timestamp' => -1357635600], // 1926-12-25'
        ['name' => '�吳', 'name_short' => 'T', 'timestamp' => -1812186000], // 1912-07-30
        ['name' => '����', 'name_short' => 'M', 'timestamp' => -3216790800], // 1868-01-25
    );
    /** ���{��j���ݒ� */
    private static $weekJp = [
        0 => '��',
        1 => '��',
        2 => '��',
        3 => '��',
        4 => '��',
        5 => '��',
        6 => '�y',
    ];
    /** �ߑO�ߌ� */
    private static $ampm = [
        'am' => '�ߑO',
        'pm' => '�ߌ�',
    ];

    /**
     * �a��Ȃǂ�ǉ�����date�֐�
     *
     * �ǉ������L��
     * J : ����
     * b : ��������
     * K : �a��N(1�N�����N�ƕ\�L)
     * k : �a��N
     * x : ���{��j��(0:��-6:�y)
     * E : �ߑO�ߌ�
     */
    public static function date($format, $timestamp = null)
    {
        // �a��֘A�̃I�v�V����������ꍇ�͘a��擾
        $gengo = array();
        $timestamp = is_null($timestamp) ? time() : $timestamp;
        if (preg_match('/[J|b|K|k]/', $format)) {
            foreach (self::$gengoList as $g) {
                if ($g['timestamp'] <= $timestamp) {
                    $gengo = $g;
                    break;
                }
            }
            // �������擾�ł��Ȃ��ꍇ��Exception
            if (empty($gengo)) {
                throw new Exception('Can not be converted to a timestamp : '.$timestamp);
            }
        }

        // J : ����
        if (preg_match('/J/', $format)) {
            $format = preg_replace('/J/', $gengo['name'], $format);
        }

        // b : ��������
        if (preg_match('/b/', $format)) {
            $format = preg_replace('/b/', $gengo['name_short'], $format);
        }

        // K : �a��p�N(���N�\��)
        if (preg_match('/K/', $format)) {
            $year = date('Y', $timestamp) - date('Y', $gengo['timestamp']) + 1;
            $year = $year == 1 ? '��' : $year;
            $format = preg_replace('/K/', $year, $format);
        }

        // k : �a��p�N
        if (preg_match('/k/', $format)) {
            $year = date('Y', $timestamp) - date('Y', $gengo['timestamp']) + 1;
            $format = preg_replace('/k/', $year, $format);
        }

        // x : ���{��j��
        if (preg_match('/x/', $format)) {
            $w = date('w', $timestamp);
            $format = preg_replace('/x/', self::$weekJp[$w], $format);
        }

        // �ߑO�ߌ�
        if (preg_match('/E/', $format)) {
            $a = date('a', $timestamp);
            $format = preg_replace('/E/', $ampm[$a], $format);
        }

        return date($format, $timestamp);
    }

}
?>