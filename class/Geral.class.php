<?php

class Geral {
    
    /*function ntp_time() {
        $host='pool.ntp.br';
        // Create a socket and connect to NTP server
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_connect($sock, $host, 123);

        // Send request
        $msg = "\010" . str_repeat("\0", 47);
        socket_send($sock, $msg, strlen($msg), 0);

        // Receive response and close socket
        socket_recv($sock, $recv, 48, MSG_WAITALL);
        socket_close($sock);

        // Interpret response
        $data = unpack('N12', $recv);
        $timestamp = sprintf('%u', $data[9]);

        // NTP is number of seconds since 0000 UT on 1 January 1900
        // Unix time is seconds since 0000 UT on 1 January 1970
        $timestamp -= 2208988800;
        //$timestamp -=   2208999600; //Diminuir mais tempo devido ao GMT 0, do Brasil é o -3
        //$this->set('timestamp',$timestamp); 
        return $timestamp;	
    }*/ 
    
    //Formata a data para o formato do brasil
    public function formataData($data){
        $array = explode('-', $data);
        $date = $array[2].'/'.$array[1].'/'.$array[0];
        return $date;
    }
    
    //Formata a data para o formato do banco
    public function formataDataBanco($data){
        $array = explode('/', $data);
        $date = $array[2].'-'.$array[1].'-'.$array[0];
        return $date;
    }


    //Converte segundo para H:m:s
    public function converteSegundos($segundosParaConverter){
        $segundos = (int)($segundosParaConverter%60);
        $minutos = (int)($segundosParaConverter/60%60);
        $horas = (int)($segundosParaConverter/3600);
        if ($segundos < 10)
            $segundos = '0'.$segundos;
        if ($minutos < 10)
            $minutos = '0'.$minutos;
        if ($horas < 10)
            $horas = '0'.$horas;
        return "{$horas}:{$minutos}:{$segundos}";
    }
    
}

?>
