<?php

use App\Enums\Classroom;
use App\Enums\Schedule;
use Carbon\Carbon;
use Japanese\Holiday\Repository as HolidayRepository;

if (!function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Mayo01');
    }
}

if (!function_exists('generateCode')) {

    /**
     * Generate code for register user
     */
    function generateCode(string $model)
    {
        $uuid = mt_rand(100000, 999999);
        while ($model::where('code', $uuid)->first()) {
            $uuid = mt_rand(100000, 999999);
        }
        return $uuid;
    }
}

if (!function_exists('checkCompetitionDay')) {

    /**
     * Generate code for register user
     */
    function checkCompetitionDay($date): bool
    {
        $holidayRepository = new HolidayRepository();
        return $holidayRepository->isHoliday($date) || date('N', strtotime($date)) > WEEKEND;
    }
}

if (!function_exists('escapeSpecialCharacter')) {
    /**
     * Function to escape special character in sql like(%)
     *
     * SQLの特殊文字をエスケープする関数like（％）
     * @param $string
     * @return string|string[]
     */
    function escapeSpecialCharacter($string)
    {
        $search = array('%', '_');
        $replace = array('\%', '\_');
        return str_replace($search, $replace, $string);
    }
}

if (!function_exists('getDateFormat')) {
    /**
     * Get Date Has Format yyy-mm-dd
     * @param string $timeRequest
     * @param string $separator option
     * @return false|string date has format yyy-mm-dd
     */
    function getDateFormat($timeRequest, $separator = '-')
    {
        $times = explode($separator, $timeRequest, 3);

        if (count($times) != 3) {
            return false;
        }

        list($year, $month, $day) = array_map(function ($t) {
            if (!is_numeric($t)) {
                return 0;
            }

            return $t;
        }, $times);

        if (false === strtotime($year . '/' . $month . '/' . $day)) {
            return false;
        }

        if (checkdate($month, $day, $year)) {
            return "$year-$month-$day";
        }

        return false;
    }
}

if (!function_exists('levelOfParticipant')) {
    /**
     * Convert Level Of Participant Type Int To Text Kana
     */
    function levelOfParticipant(int $participantLevel, int $scheduleType)
    {
        $levels = App\Enums\Level::toArray();
        $types = TYPE_CLASS[$scheduleType];

        return $levels[$types][$participantLevel];
    }
}

if (!function_exists('appendColumnEmpty')) {
    function appendColumnEmpty($count, $column, $totalCount): string
    {
        $totalCell = ($totalCount - $count) * $column;
        return str_repeat('<td></td>', $totalCell);
    }
}

if (!function_exists('levels')) {
    function levels($scheduleType)
    {
        $levels = App\Enums\Level::toArray();
        $types = TYPE_CLASS[$scheduleType];

        return $levels[$types];
    }
}

if (!function_exists('renderStatus')) {
    function renderStatus($enum, $status): string
    {
        return $enum::STATUS[$status];
    }
}

if (!function_exists('isTeachable')) {
    function isTeachable($selectedSubject, $listSubjects)
    {
        return in_array($selectedSubject, $listSubjects) ? Schedule::TEACHABLE : Schedule::UNTEACHABLE;
    }
}

if (!function_exists('getSubjectId')) {
    function getSubjectId($dataRow)
    {
        $dataSubjects = [];
        unset($dataRow['数']);
        foreach ($dataRow as $item => $value) {
            if ($value === ACTIVE) {
                $dataSubjects[] = TYPE_SUBJECT[strtolower($item)];
            }
        }
        return $dataSubjects;
    }
}

if (!function_exists('getDeadlineDefault')) {
    function getDeadlineDefault($startTime): string
    {
        if (strtotime($startTime) < strtotime(Classroom::COMPARE_TIME)) {
            return Classroom::DEADLINE['morning'];
        }
        return Classroom::DEADLINE['afternoon'];
    }
}

if (!function_exists('checkDeadlineLesson')) {
    function checkDeadlineLesson($lesson)
    {
        return (Carbon::now()->format('H:i') > $lesson->deadline) && ($lesson->date_book === Carbon::now()->format('Y-m-d'));
    }
}
