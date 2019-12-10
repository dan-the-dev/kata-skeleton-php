<?php

namespace Bowling;

use Exception;

class Game
{
    const STRIKE_SPARE_BASE_POINTS = 10;
    protected $rolls = array();

    public function roll(string $pins): void
    {
        array_push($this->rolls, $pins);
    }

    public function score(): int
    {
        $score = 0;
        $count = 0;
        foreach ($this->rolls as $pos => $roll) {
            $count++;
            $score += $this->getRollScore($pos, $roll);
            if ($count == 10) {
                break;
            }
        }
        return $score;
    }

    protected function getRollScore(int $pos, string $roll): int
    {
        if ($roll === 'X') {
            return $this->getStrikeScore($pos, $roll);
        }
        if (strpos($roll, '/') !== FALSE) {
            return $this->getSpareScore($pos, $roll);
        }
        return $this->getSimpleScore($roll);
    }

    protected function getNextRollScore(int $pos): int
    {
        $roll = $this->rolls[$pos];
        if ($roll === 'X' || strpos($roll, '/') !== FALSE) {
            return self::STRIKE_SPARE_BASE_POINTS;
        }
        return $this->getSimpleScore($roll);
    }

    protected function getStrikeScore(int $pos, string $roll): int
    {
        $score = self::STRIKE_SPARE_BASE_POINTS + $this->getNextRollScore($pos + 1) + $this->getNextRollScore($pos + 2);
        return $score;
    }

    protected function getSpareScore(int $pos, string $roll): int
    {
        $last = substr($roll, -1);
        $lastIsPoint = $last !== '/';
        if ($lastIsPoint) {
            return self::STRIKE_SPARE_BASE_POINTS + intval($last);
        } else {
            return self::STRIKE_SPARE_BASE_POINTS + $this->getFirstThrowScore($roll);
        }
    }

    protected function getSimpleScore(string $roll): int
    {
        return $this->getFirstThrowScore($roll) + $this->getSecondThrowScore($roll);
    }

    protected function getFirstThrowScore(string $roll): int
    {
        $points = $this->getRollPoints($roll);
        return $this->getThrowScore($points[0]);
    }

    protected function getSecondThrowScore(string $roll): int
    {
        $points = $this->getRollPoints($roll);
        return $this->getThrowScore($points[1]);
    }

    protected function getThrowScore(string $point): int
    {
        return $point === '-' ? 0 : intval($point);
    }

    protected function getRollPoints(string $roll): array
    {
        return str_split($roll);
    }
}
