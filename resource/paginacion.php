                                <div id="paginacion" class="text-center">
											<ul class="pagination">
												<?
												if($total_registros>$registros){
													if (($pag-1)>0){
														echo "<li><a href='".$pagina.".php?pag=".($pag-1)."&q=$buscar&tag_p=$tag_p&tag=$tag'>Anterior</a></li>";
													}else{
														echo "<li class='li-pag'>Anterior</li>";
													}
												}
												//Numero de paginas a mostrar
												$num_pag=5;
												//Limitamos las paginas mostradas
												$pagina_intervalo=ceil($num_pag/2)-1;

												//caculamos desde que numero de pagina se mostrara
												$pagina_desde=$pag-$pagina_intervalo;
												$pagina_hasta=$pag+$pagina_intervalo;

												//Verificar que pagina_desde sea negativo

												if ($pagina_desde<1){//Le sumamos la cantidad sobrante para mantener el numero de enlaces mostrados 
													$pagina_hasta-=($pagina_desde-1); 
													$pagina_desde=1;
												}
											    // Verificar que pagina_hasta no sea mayor que paginas_totales 
												if($pagina_hasta>$total_paginas){
													$pagina_desde-=($pagina_hasta-$total_paginas);
													$pagina_hasta=$total_paginas;
													if($pagina_desde<1){
														$pagina_desde=1;
													}
												}

												for ($i=$pagina_desde; $i<=$pagina_hasta; $i++){
													if ($pag==$i){
														echo "<li class='pagination-activo'><span>".$pag."</span></li>";
													}else{
														echo "<li><a href='".$pagina.".php?pag=$i&q=$buscar&tag_p=$tag_p&tag=$tag'>$i</a></li>";
													}
												}

												if(($pag+1)<=$total_paginas){
													echo "<li><a href='".$pagina.".php?pag=".($pag+1)."&q=$buscar&tag_p=$tag_p&tag=$tag'>Siguiente</a></li>";
												}else{
													echo "<li class='li-pag'>Siguiente</li>";
												}
												?>
											</ul>
					</div>