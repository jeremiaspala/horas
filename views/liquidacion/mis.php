<br/><br/><button onclick="window.location.href='<?=base_url?>liquidacion/nuevo'" class="btn btn-success mb-2">Nueva Liquidación</button>
<br/>
<div class="row invoice layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="app-hamburger-container">
                            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                        </div>
                        <div class="doc-container">
                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="search">
                                            <input type="text" class="form-control" placeholder="Buscar">
                                        </div>
                                        <ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
                                            <?php
                                            foreach ($liq as $r):
                                            ?>
                                            <!--Pedido!-->
                                            <li class="nav-item">
                                                <div class="nav-link list-actions" id="invoice-<?=$r['id'];?>" data-invoice-id="<?=$r['id'];?>">
                                                    <div class="f-m-body">
                                                        <div class="f-head">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                        </div>
                                                        <div class="f-body">
                                                            <p class="invoice-number">Liquidacion #<?=$r['id'];?></p>
                                                            <p class="invoice-customer-name"><span>De:</span> <?=$r['nombre']." ".$r['apellidos'];?></p>
                                                            <p class="invoice-generated-date">Fecha: <?=$r['created_at']?></p>
                                                            
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            endforeach;
                                            ?>
                                            <!--Pedido-->
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-container">
                                <div class="invoice-inbox">

                                    <div class="inv-not-selected">
                                        <p>Seleccione una liquidación para ver el detalle.</p>
                                    </div>

                                    <div class="invoice-header-section">
                                        <h4 class="inv-number"></h4>
                                        <div class="invoice-action">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                        </div>
                                    </div>
                                    
                                    <div id="ct" class="">
                                        <?php
                                            foreach ($liq as $lp):               
                                        ?>
                                         <!--Principio invoice -->
                                        <div class="invoice-<?=$lp['id']?>">
                                            <div class="content-section  animated animatedFadeInUp fadeInUp">

                                                <div class="row inv--head-section">

                                                    <div class="col-sm-6 col-12">
                                                        <h3 class="in-heading">Liquidación</h3>
                                                    </div>
                                                    <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                                        <div class="company-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hexagon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                                                            <h5 class="inv-brand-name">FX Sistemas</h5>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row inv--detail-section">

                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-to">Liquidación de:</p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                                        <p class="inv-detail-title">Equipo de trabajo: <?=$lp['trabajo']?></p>
                                                    </div>
                                                    
                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-customer-name"><?=$lp['nombre']." ".$lp['apellidos']?></p>
                                                        <p class="inv-street-addr"><?=$lp['celular']?></p>
                                                        <p class="inv-email-address"><?=$lp['email'] ?></p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                                        <p class="inv-list-number"><span class="inv-title">Pedido Número : </span> <span class="inv-number">#<?=$lp['id']?></span></p>
                                                        <p class="inv-created-date"><span class="inv-title">Fecha de liquidación : </span> <span class="inv-date"><?=$lp['created_at']?></span></p>
                                                        <p class="inv-due-date"><span class="inv-title">A pagar : </span> <span class="inv-date"> En los 30 días después de liquidado</span></p>
                                                    </div>
                                                </div>

                                                <div class="row inv--product-table-section">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="">
                                                                    <tr>
                                                                        <th scope="col">Horas</th>
                                                                        <th scope="col">Descripción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    $li = new Horas();
                                                                    $linea = $li->getAllLiq($lp['persona_id']);
                                                                    $total = 0;
                                                                    foreach ($linea as $l):
                                                                    ?>
                                                                    <tr id="lp<?=$l['id']?>">

                                                                        <td class="text-left"><?=$l['horas']?> Hs</td>
                                                                        <td class="text-left"><?=$l['descripcion']?></td>
                                                                    </tr>                                                                   
                                                                    <?php
                                                                    endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                        <div class="inv--payment-info">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <h6 class=" inv-title">Forma de Pago:</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12">
                                                                    <p class=" inv-subtitle">Email de contacto: </p>
                                                                </div>
                                                                <div class="col-sm-8 col-12">
                                                                    <p class=""><?=$lp['email']?></p>
                                                                </div>
                                                                <div class="col-sm-4 col-12">
                                                                    <p class=" inv-subtitle">Teléfono de contacto : </p>
                                                                </div>
                                                                <div class="col-sm-8 col-12">
                                                                    <p class=""><?=$lp['celular']?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="inv--total-amounts text-sm-right">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Total horas: </p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class=""><?=$lp['horas']?> Hs</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Total $: </p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">$<?=$lp['valor']?></p>
                                                                </div>
                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> 
                                        <!--Fin invoice -->
                                        <?php 
                                            endforeach;
                                        ?>
                                        
                                    </div>


                                </div>

                                <div class="inv--thankYou">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <p class="">Gracias por confiar en nosotros.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                    </div>
                </div>