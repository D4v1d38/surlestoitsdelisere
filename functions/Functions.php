<?php
class Functions
{
    public function getActualYear(){
        return $actualYear = Date('Y');
    }

    //Calcul Heure/Min/Sec en fonction des secondes
    public function secondsToTime(int $seconds):array{
        $temp = $seconds % 3600;
        
        $durationHours=($seconds-$temp)/3600;
        $durationSeconds=$temp % 60;
        $durationMinutes=($temp-$durationSeconds) / 60;
        return [$durationHours,$durationMinutes,$durationSeconds];
    }

    // Message d'informations
    public function messageInfo(string $message, string $action,string $class):bool{
        header('location:index.php?action='.$action.'&message='.$message.'&class='.$class);
        exit();
    }
}