<?php

class Team
{
    private $teamTrainer;
    private $teamName;
    private $teamLogo;
    private $teamPlayers = [];


    public function __construct()
    {
        $this->teamTrainer = NAMES[array_rand(NAMES)] . ' ' . SURNAMES[array_rand(SURNAMES)];
        $this->teamName = TEAM_ADJECTIVES[array_rand(TEAM_ADJECTIVES)] . ' ' . TEAM_NOUNS[array_rand(TEAM_NOUNS)];
        $this->teamLogo = 'assets/logos/img-' . rand(1, 120) .'.svg';

        for ($x = 0; $x < rand(5, 8); $x++) {
            $this->teamPlayers[] = new Player();
        }
        $this->teamPlayers[] = $this->convertObjectToArray();
    }

    /**
     * @return mixed
     */
    public function getTeamPlayers()
    {
        return $this->teamPlayers;
    }

    /**
     * @return string
     */
    public function getTeamTrainer(): string
    {
        return $this->teamTrainer;
    }

    /**
     * @return string
     */
    public function getTeamLogo(): string
    {
        return $this->teamLogo;
    }

    /**
     * @return string
     */
    public function getTeamName(): string
    {
        return $this->teamName;
    }

    function convertObjectToArray()
    {
        $teamPlayers = [
            'teamName' => $this->getTeamName(),
            'teamTrainer' => $this->getTeamTrainer(),
            'teamLogo' => $this->getTeamLogo(),

        ];
        return $teamPlayers;
    }

}


?>