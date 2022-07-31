<?php

namespace Root\Code;

class Tennis
{
    private int $firstPlayerScoreTimes = 0;
    private array $scoreLookup = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty',
    ];
    private int $secondPlayerScoreTimes = 0;
    private string $firstPlayerName;
    private string $secondPlayerName;

    public function __construct(string $firstPlayerName, string $secondPlayerName)
    {
        $this->firstPlayerName = $firstPlayerName;
        $this->secondPlayerName = $secondPlayerName;
    }

    public function score(): string
    {
        return $this->isScoreDiff()
            ? ($this->isNextScoreGamePoint() ? $this->advState() : $this->lookupScore())
            : ($this->isDeuce() ? $this->deuce() : $this->sameScore());
    }

    public function firstPlayerScore(): void
    {
        $this->firstPlayerScoreTimes++;
    }

    public function secondPlayerScore(): void
    {
        $this->secondPlayerScoreTimes++;
    }

    private function advPlayer(): string
    {
        return $this->firstPlayerScoreTimes > $this->secondPlayerScoreTimes ? $this->firstPlayerName : $this->secondPlayerName;
    }

    private function isAdv(): bool
    {
        return abs($this->firstPlayerScoreTimes - $this->secondPlayerScoreTimes) === 1;
    }

    private function isNextScoreGamePoint(): bool
    {
        return $this->firstPlayerScoreTimes > 3 || $this->secondPlayerScoreTimes > 3;
    }

    private function isScoreDiff(): bool
    {
        return $this->firstPlayerScoreTimes !== $this->secondPlayerScoreTimes;
    }

    private function lookupScore(): string
    {
        return $this->scoreLookup[$this->firstPlayerScoreTimes] . ' ' . $this->scoreLookup[$this->secondPlayerScoreTimes];
    }

    private function isDeuce(): bool
    {
        return $this->firstPlayerScoreTimes >= 3;
    }

    private function deuce(): string
    {
        return 'Deuce';
    }

    private function sameScore(): string
    {
        return $this->scoreLookup[$this->firstPlayerScoreTimes] . ' All';
    }

    private function advState(): string
    {
        return $this->isAdv() ? $this->advPlayer() . ' Adv' : $this->advPlayer() . ' Win';
    }
}
