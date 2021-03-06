<table id="pontos" class="table table-bordered table-striped">
	
	<thead>
	
	  <tr>
		<th> Usuário </th>
		<th> Data </th>
		<th> Entrada </th>
		<?php
		//Estava dando erro na paginação
		//if ($vinculo == 'Funcionario'){ //Só tem entrada almoco e volta almoco caso seja funcionário
		?>
			<th> Entrada almoço </th>
			<th> Volta almoço </th>
		<?php
		//}
		?>
		<th> Saída </th>
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
                <td> <?php echo $usuario->getUsuario(); ?> </td>
                <td> <?php echo $objGeral->formataData($ponto['dia']); ?> </td>
                <td> <?php echo date('H:i:s', $ponto['entrada']); ?> </td>
                <?php
                //Estava dando erro na paginação
                //if ($vinculo == 'Funcionario'){ //Só tem entrada almoco e volta almoco caso seja funcionário 
                    if($ponto['entrada_almoco'] == 0){
                ?>
                        <td>Inexistente</td>
                <?php
                    }else{
                ?>
                        <td> <?php echo date('H:i:s',$ponto['entrada_almoco']); ?> </td>
                <?php
                    }
                    if($ponto['volta_almoco'] == 0){
                ?>
                        <td>Inexistente</td>
                <?php
                    }else{
                ?>
                    <td> <?php echo date('H:i:s',$ponto['volta_almoco']); ?> </td>
                <?php
                    }
                //}   
                    if($ponto['saida'] == 0){
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
                        if ($vinculo == 'Funcionario'){
                            if ( ($ponto['entrada_almoco']!=0) && ($ponto['saida']==0) ){
                                $segundosTrabalhadosDia = $ponto['entrada_almoco']-$ponto['entrada'];
                                //echo date('H:i:s', $segundosTrabalhadosDia);
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                            }else if ($ponto['saida']!=0){
                                $segundosTrabalhadosDia = ($ponto['entrada_almoco']-$ponto['entrada'])+($ponto['saida']-$ponto['volta_almoco']);
                                //echo date('H:i:s', $segundosTrabalhadosDia);
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                            }else{
                                echo $objGeral->converteSegundos($segundosTrabalhadosDia);
                                //echo date('H:i:s',$segundosTrabalhadosDia);
                            }
                            $segundosTrabalhados += $segundosTrabalhadosDia;
                        }else if ($vinculo == 'Estagiario'){
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
                    if ($vinculo == 'Funcionario'){
                        echo $objGeral->converteSegundos(28800);
                        //echo date('H:i:s',28800);
                    }else if ($vinculo == 'Estagiario'){
                        echo $objGeral->converteSegundos(14400);
                        //echo date('H:i:s',14400);
                    }
                ?> 
                </td>
                <td>
                <?php
                    if ($vinculo == 'Funcionario'){
                        if ($segundosTrabalhadosDia >= 28800){
                            //$segundosPeriodo += $segundosTrabalhadosDia;
                            echo $objGeral->converteSegundos($segundosTrabalhadosDia-28800);
                            //echo date('H:i:s',$segundosTrabalhadosDia-28800);
                        }else{
                             //$segundosPeriodo -= $segundosTrabalhadosDia;
                             //echo '-'.date('H:i:s',28800-$segundosTrabalhadosDia);
                             echo '-'.$objGeral->converteSegundos(28800-$segundosTrabalhadosDia);
                        }
                    }else if ($vinculo == 'Estagiario'){
                        if ($segundosTrabalhadosDia >= 14400){
                            //$segundosPeriodo += $segundosTrabalhadosDia;
                            echo $objGeral->converteSegundos($segundosTrabalhadosDia-14400);
                            //echo date('H:i:s',$segundosTrabalhadosDia-14400);
                        }else{
                             //$segundosPeriodo -= $segundosTrabalhadosDia;
                             echo '-'.$objGeral->converteSegundos(14400-$segundosTrabalhadosDia);
                        }
                   }
                ?>
                </td>
            </tr>
		<?php
		}
		?>
	 
	</tbody>
	<tfoot>
	  <tr>
		
        <?php
        //if ($vinculo == 'Estagiario'){
        ?>
        <!--    <th colspan="4">Total</th> -->
        <?php
        //}else if ($vinculo == 'Funcionario') {
        ?>
            <th colspan="6">Total</th>
        <?php
        //}
        ?>
            <th> <?php echo $objGeral->converteSegundos($segundosTrabalhados);  ?>  </th>
        <th> 
            <?php
            if ($vinculo == 'Estagiario'){
                  $horasParaTrabalhar = $qtdPontos*14400;
            }else if ($vinculo == 'Funcionario'){
                $horasParaTrabalhar = $qtdPontos*28800;
            }
            echo $objGeral->converteSegundos($horasParaTrabalhar);
            ?> 
        </th>
        <th> 
            <?php
            if ($segundosTrabalhados >= $horasParaTrabalhar){
                echo $objGeral->converteSegundos($segundosTrabalhados-$horasParaTrabalhar);
            }else{
                echo '-'.$objGeral->converteSegundos($horasParaTrabalhar-$segundosTrabalhados);
            } 
            ?> 
        </th>
		
	  </tr>
	</tfoot>
</table>