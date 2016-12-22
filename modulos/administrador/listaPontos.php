<table id="pontos" class="table table-bordered table-striped">
	    
    <thead>
        <tr>
            <th> Usu&aacute;rio </th>
            <th> Data </th>
            <th> Entrada </th>
            <th> Entrada almo&ccedil;o </th>
            <th> Volta almo&ccedil;o </th>
            <th> Sa&iacute;da </th>
            <th> Horas trabalhadas </th>
            <th> Horas a trabalhar </th>
            <th> Diferença </th>
        </tr>
    </thead>
    
    <tbody>
    <?php
        foreach ($pontos as $ponto){
    ?>
            <tr>
                <td> <?php echo $ponto['usuario']; ?> </td>
                <td><?php echo $objGeral->formataData($ponto['dia']); ?> </td>
                <td><?php echo date('H:i:s', $ponto['entrada']); ?> </td>
                <?php
                if ($ponto['entrada_almoco'] == 0){
                ?>
                   <td>Inexistente</td>
                <?php
                }else{
                ?>
                    <td> <?php echo date('H:i:s',$ponto['entrada_almoco']); ?> </td>
                <?php
                }
                if ($ponto['volta_almoco'] == 0){
                ?>
                   <td>Inexistente</td>
                <?php
                }else{
                ?>
                    <td> <?php echo date('H:i:s',$ponto['volta_almoco']); ?> </td>
                <?php
                }
                if ($ponto['saida'] == 0){
                ?>
                   <td>Inexistente</td>
                <?php
                }else{
                ?>
                    <td> <?php echo date('H:i:s',$ponto['saida']); ?> </td>
                <?php
                }
                ?>
                <td>
                <?php
                    $segundosTrabalhadosDia = 0;
                        if ($ponto['vinculo'] == 'Funcionario'){
                            if ( ($ponto['entrada_almoco']!=0) && ($ponto['saida']==0) ){
                                $segundosTrabalhadosDia = $ponto['entrada_almoco']-$ponto['entrada'];
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s', $segundosTrabalhadosDia);
                            }else if ($ponto['saida']!=0){
                                $segundosTrabalhadosDia = ($ponto['entrada_almoco']-$ponto['entrada'])+($ponto['saida']-$ponto['volta_almoco']);
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s', $segundosTrabalhadosDia);
                            }else{
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s',$segundosTrabalhadosDia);
                            }
                            $segundosTrabalhados += $segundosTrabalhadosDia;
                        }else if ($ponto['vinculo'] == 'Estagiario'){
                            if( ($ponto['entrada']!=0) && ($ponto['saida']!=0) ){
                                $segundosTrabalhadosDia = $ponto['saida']-$ponto['entrada'];
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s',$segundosTrabalhadosDia);
                                $segundosTrabalhados += $segundosTrabalhadosDia;
                            }else{ //Caso não tenha entrada ou saida
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s',$segundosTrabalhadosDia);
                            }
                        }

                ?>
                </td>
                <td>
                <?php
                    if ($ponto['vinculo'] == 'Funcionario'){
                        echo $objGeral->converteSegundos(28800);
                        //echo date('H:i:s',28800);
                    }else if ($ponto['vinculo'] == 'Estagiario'){
                        echo $objGeral->converteSegundos(14400);
                        //echo date('H:i:s',14400);
                    }
                ?> 
                </td>
                <td>
                <?php
                    if ($ponto['vinculo'] == 'Funcionario'){
                        if ($segundosTrabalhadosDia >= 28800){
                            echo $objGeral->converteSegundos($segundosTrabalhadosDia-28800);
                            //$segundosPeriodo += $segundosTrabalhadosDia;
                            //echo date('H:i:s',$segundosTrabalhadosDia-28800);
                        }else{
                            echo '-'.$objGeral->converteSegundos(28800-$segundosTrabalhadosDia);
                             //$segundosPeriodo -= $segundosTrabalhadosDia;
                            //echo '-'.date('H:i:s',28800-$segundosTrabalhadosDia);
                        }
                    }else if ($ponto['vinculo'] == 'Estagiario'){
                        if ($segundosTrabalhadosDia >= 14400){
                            echo $objGeral->converteSegundos($segundosTrabalhadosDia-14400);
                            //$segundosPeriodo += $segundosTrabalhadosDia;
                            //echo date('H:i:s',$segundosTrabalhadosDia-14400);
                        }else{
                            echo '-'.$objGeral->converteSegundos(14400-$segundosTrabalhadosDia);
                             //$segundosPeriodo -= $segundosTrabalhadosDia;
                            //echo '-'.date('H:i:s',14400-$segundosTrabalhadosDia);
                        }
                   }
                ?>
                </td>
            </tr>
    <?php
        }
    ?>
    </tbody>

</table>