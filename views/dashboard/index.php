<div class="page-header">
                    <div class="page-title">
                        <h3>VPN Dashboard</h3>
                    </div>

                </div>

                <div class="row layout-top-spacing">

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="" style="color:red">Usuarios más conectados</h5>
                            </div>
                            <div class="widget-content">
                            <?php
                                foreach ($tpuh as $con):
                            ?>
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><b><?=$con['user']?></b></h4>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span><?=$con['total_uptime_hhmmss']?></span> <b>Hs.</b></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    endforeach;
                                ?>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        
                        <div class="widget widget-activity-four">

                            <div class="widget-heading">
                                <h5 class="">Acciones Recientes</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        <?php
                                        foreach ($la as $con):
                                        ?>
                                        <div class="item-timeline timeline-primary">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span><?=$con['remote_addr']?></span> <b><?=$con['user']?></b></p>
                                                <p><span><?=$con['local_addr']?> | <b><span><?= strtoupper($con['service'])?></b></span></span></p>
                                                <?php 
                                                if($con['event_type']==="up"){
                                                    $badge="badge-success";
                                                }else{
                                                    $badge="badge-danger";
                                                }
                                                
                                                ?><p><span class="badge <?=$badge?>">Conexión: <?=$con['event_type']?></span></p>
                                                <p class="t-time"><?=$con['event_time']?></p>
                                            </div>
                                        </div>
                                        <?php
                                        endforeach;
                                        ?>

                                    </div>                                    
                                </div>

                                <div class="tm-action-btn">
                                    <button class="btn">View All <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        
                        <div class="widget widget-account-invoice-one">

                            <div class="widget-heading">
                                <h5 class="">Account Info</h5>
                            </div>

                            <div class="widget-content">
                                <div class="invoice-box">
                                    
                                    <div class="acc-total-info">
                                        <h5>Balance</h5>
                                        <p class="acc-amount">$470</p>
                                    </div>

                                    <div class="inv-detail">                                        
                                        <div class="info-detail-1">
                                            <p>Monthly Plan</p>
                                            <p>$ 199.0</p>
                                        </div>
                                        <div class="info-detail-2">
                                            <p>Taxes</p>
                                            <p>$ 17.82</p>
                                        </div>
                                        <div class="info-detail-3 info-sub">
                                            <div class="info-detail">
                                                <p>Extras this month</p>
                                                <p>$ -0.68</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>Netflix Yearly Subscription</p>
                                                <p>$ 0</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>Others</p>
                                                <p>$ -0.68</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="inv-action">
                                        <a href="" class="btn btn-dark">Summary</a>
                                        <a href="" class="btn btn-danger">Transfer</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5 class="" style="color:green;">Usuarios Online</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Usuario</div></th>
                                                <th><div class="th-content">IP Publica</div></th>
                                                <th><div class="th-content">IP Privada</div></th>
                                                <th><div class="th-content th-heading">Login</div></th>
                                                <th><div class="th-content">Servicio</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                                foreach ($vp as $con):
                                                ?>
                                                <tr>
                                                    <td><div class="td-content"><span class="badge outline-badge-success"><?= strtoupper($con['user'])?></span></div></td>
                                                    <td><div class="td-content"><?=$con['remote_addr']?></div></td>
                                                    <td><div class="td-content"><?=$con['local_addr']?></div></td>
                                                    <td><div class="td-content"><span class=""><?=$con['started_at']?></span></div></td>
                                                    <td><div class="td-content"><span class="badge outline-badge-success"><?=strtoupper($con['service'])?></span></div></td>
                                                </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three">

                            <div class="widget-heading">
                                <h5 class="">Top Usuarios Mes</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Usuario</div></th>
                                                <th><div class="th-content th-heading">Total (hh:mm:ss)</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                foreach ($tpuh as $con):
                                                ?>
                                                <tr>
                                                    <td><div class="td-content"><?=$con['user']?></div></td>

                                                    <td><div class="td-content"><span class=""><?=$con['total_uptime_hhmmss']?></span></div></td>
                                                </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>