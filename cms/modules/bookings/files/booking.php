<?php
$_use_routes = false;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$id_booking = $_REQUEST['id'];
$booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $id_booking);
$passengers = db_query('SELECT * FROM booking_passenger WHERE id_booking = ?', $id_booking);
$search_data = json_decode($booking['search_data'], true);
$selected_data = json_decode($booking['selected_data'], true);

// Start output
include $_base_path_cms . 'content/section/meta.php';
?>
<section class="body">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">
                        Rezervare #<?php echo $booking['id_booking'] ?>
                        <span class="label label-<?php echo $booking_status_label[$booking['status']] ?> pull-right"><?php echo $booking_status[$booking['status']] ?></span>
                    </h2>
                </header>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Booking</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Data</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo date("d.m.Y H:i:s", strtotime($booking['created'])) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>ID Booking</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['id_booking'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Status</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $_booking_statuses[$booking['status']] ?>
                                </div>
                            </div>
                            <br>
                            <? if($booking['type'] == "insurance"){?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>ID City</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['city_insurance_booking_id'] ?>
                                    </div>
                                </div>
                                <br>
                            <? }else{ ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>ID Eurosite</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['eurosite_booking_id'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Eroare Eurosite</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['eurosite_error'] ?>
                                    </div>
                                </div>
                                <br>
                            <? }?>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Pret total</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['total'] ?> <?php echo $booking['currency'] ?>
                                    <? if($booking['old_total'] > 0){?>
                                        (<span style="text-decoration:line-through;"><?php echo $booking['old_total'] ?> <?php echo $booking['currency'] ?>)
                                    <? }?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Pret total (RON)</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['total_ron'] ?> RON
                                    <? if($booking['old_total'] > 0){?>
                                        (<span style="text-decoration:line-through;"><?php echo $booking['old_total_ron'] ?> RON)
                                    <? }?>
                                </div>
                            </div>
                            <? if($booking['discount'] > 0){?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Discount</b>
                                    </div>
                                    <div class="col-md-8">
                                        - <?php echo $booking['discount'] ?> <?php echo $booking['currency'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Discount (RON)</b>
                                    </div>
                                    <div class="col-md-8">
                                        - <?php echo $booking['discount'] ?> RON
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Cod voucher</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['voucher'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Pret final</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['total']-$booking['discount'] ?> <?php echo $booking['currency'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Pret final (RON)</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $booking['total_ron']-$booking['discount_ron'] ?> RON
                                    </div>
                                </div>
                            <? }?>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Curs EUR</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['currency_to_ron'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Tip plata</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo ucfirst($booking['pay_amount']) ?>
                                    <? if($booking['pay_amount'] != "full"){?>
                                        (<?php echo $booking['advance_total'] ?> <?php echo $booking['currency'] ?> = <?php echo $booking['advance_total_ron'] ?> RON)
                                        <? if($booking['discount'] > 0){?>
                                            <br>
                                            (Discount: <?php echo $booking['discount_advance'] ?> <?php echo $booking['currency'] ?> = <?php echo $booking['discount_advance_ron'] ?> RON)
                                        <? }?>
                                    <? }?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Metoda plata</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo ucfirst($booking['payment']) ?>
                                    <? //if($booking['payment'] == "cash" || $booking['payment'] == "voucher"){?>
                                        <? $agency = db_row('SELECT * FROM agency WHERE id_agency = ?', $booking['id_agency']);?>
                                        - <?php echo $agency['title'] ?>
                                        - Agent: <?=$booking['agent']?>
                                    <? //}?>
                                    <? if($booking['payment_bank'] != ""){?>
                                        - <?php echo ucfirst($booking['payment_bank']) ?>
                                    <? }?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Observatii</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo ucfirst($booking['obs']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Date facturare</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Nume</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['name'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Prenume</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['surname'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Email</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['email'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Telefon</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['phone'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Adresa</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['address'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Oras</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['city'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Judet</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['county'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Tara</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['country'] ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Tip facturare</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo strtoupper($booking['invoice']) ?>
                                </div>
                            </div>
                            <!--
                            <div class="row">
                                <div class="col-md-4">
                                    <b>CNP</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['cnp'] ?>
                                </div>
                            </div>
                            -->
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Companie</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['company'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>CUI</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['cui'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Nr reg</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $booking['nr_reg'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Detalii booking</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Tip oferta</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo ucfirst($booking['type']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Perioada</b>
                                </div>
                                <div class="col-md-8">
                                    <?php echo date("d.m.Y", strtotime($selected_data['check_in'])) ?> - <?php echo date("d.m.Y", strtotime($selected_data['check_out'])) ?>
                                </div>
                            </div>

                            <? if($booking['type'] == "insurance"){?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Destinatia</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['country']?>
                                    </div>
                                </div>

                            <? }?>

                            <? if($booking['type'] == "circuit"){?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>ID Circuit Eurosite</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['circuit_id']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Nume circuit</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$search_data['title']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Nr camere</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$search_data['rooms']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Tip camere</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['room_info']?>
                                    </div>
                                </div>

                            <? }?>

                            <? if($booking['type'] == "tourism" || $booking['type'] == "charter"){?>

                                <? $city = db_row('SELECT * FROM city WHERE code = ?', $search_data['city'])?>
                                <? $country = db_row('SELECT * FROM country WHERE id_country = ?', $city['id_country'])?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Oras</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$city['title']?>, <?=$country['title']?>
                                    </div>
                                </div>
                                <? if($booking['type'] == "charter"){?>
                                    <? $city_from = db_row('SELECT * FROM city WHERE code = ?', $search_data['from_city'])?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>Plecare din</b>
                                        </div>
                                        <div class="col-md-8">
                                            <?=$city_from['title']?>
                                        </div>
                                    </div>
                                <? }?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Cod hotel Eurosite</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['hotel_code']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Hotel</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$search_data['title']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Nr camere</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$search_data['rooms']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Tip camere</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['room_info']?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Tip masa</b>
                                    </div>
                                    <div class="col-md-8">
                                        <?=$selected_data['meal_info']?>
                                    </div>
                                </div>

                            <? }?>

                        </div>
                    </div>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Pasageri</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-none" width="100%">

                            <? if($booking['type'] == "insurance"){?>

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nume complet</th>
                                        <th>Tip</th>
                                        <th>Data nasterii</th>
                                        <th>Gender</th>
                                        <th>CNP</th>
                                        <th>CI</th>
                                        <th>Judet</th>
                                        <th>Oras</th>
                                        <th>Adresa</th>
                                        <th>Pret</th>
                                        <th>ID oferta</th>
                                        <th>&nbsp;</th>
                                        <th>ID polita</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($passengers as $i => $p) { ?>
                                        <? $insurant = $selected_data['insurance_items'][$i]?>
                                        <? $info = $search_data['insurants'][$i]?>
                                        <? $offer = json_decode($p['city_insurance_offer_id'], true)?>
                                        <? $polita = json_decode($p['city_insurance_booking_id'], true)?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $p['name'].' '.$p['surname'] ?></td>
                                            <td><?php echo $p['type'] ?></td>
                                            <td><?php echo $p['dob'] ?></td>
                                            <td><?php echo $p['gender'] ?></td>
                                            <td><?php echo $p['cnp'] ?></td>
                                            <td><?php echo $p['ci'] ?></td>
                                            <td><?php echo $p['county'] ?></td>
                                            <td><?php echo $p['city'] ?></td>
                                            <td><?php echo $p['address'] ?></td>
                                            <td><?php echo $insurant['quote']['prima'] ?> Ron</td>
                                            <td><?php echo $offer['serie']." ".$offer['numar'] ?></td>
                                            <td>
                                                <? if($offer && $p['remote_pdf_offer'] != ""){?>
                                                    <a
                                                        class="mb-xs mt-xs mr-xs btn btn-success" target="_blank"
                                                        href="<?=$p['remote_pdf_offer']?>"
                                                        data-toggle="tooltip" data-placement="top" data-original-title="Download oferta">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                    </a>
                                                <? }else{?>
                                                    <a
                                                        class="mb-xs mt-xs mr-xs btn btn-default"
                                                        href="<?=$_base_cms?>modules/bookings/files/issue_insurance_offer.php?booking=<?=$id_booking?>&insurant=<?=$p['id_booking_passenger']?>"
                                                        data-toggle="tooltip" data-placement="top" data-original-title="Emite oferta">
                                                            <i class="fa fa-file-pdf-o issue-loading"></i>
                                                    </a>
                                                <? }?>
                                            </td>
                                            <td><?php echo $polita['serie']." ".$polita['numar'] ?></td>
                                            <td>
                                                <? if($p['remote_pdf_offer'] != ""){?>
                                                    <? if($polita && $p['remote_pdf'] != ""){?>
                                                        <a
                                                            class="mb-xs mt-xs mr-xs btn btn-success" target="_blank"
                                                            href="<?=$p['remote_pdf']?>"
                                                            data-toggle="tooltip" data-placement="top" data-original-title="Download polita">
                                                                <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    <? }else{?>
                                                        <a
                                                        	class="mb-xs mt-xs mr-xs btn btn-default"
                                                        	href="<?=$_base_cms?>modules/bookings/files/issue_insurance.php?booking=<?=$id_booking?>&insurant=<?=$p['id_booking_passenger']?>"
                                                        	data-toggle="tooltip" data-placement="top" data-original-title="Emite polita">
                                                        		<i class="fa fa-file-pdf-o issue-loading"></i>
                                                        </a>
                                                    <? }?>
                                                <? }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td colspan="14">
                                                Produs: <?php echo $insurant['product']['title'] ?>
                                                <?php echo $info['is_extreme'] ? " - ".($info['zapada'] ? "Zapada, ": "").($info['aero'] ? "Aero, ": "").($info['nautic'] ? "Nautic, ": "").($info['terestru'] ? "Terestru, ": "").($info['roti'] ? "Cu Motor, ": "").($info['triatlon'] ? "Triatlon, ": "") : ""?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            <? }else{ ?>

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Camera</th>
                                        <th>Nume complet</th>
                                        <th>Tip</th>
                                        <th>Data nasterii</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($passengers as $i => $p) { ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $p['room'] ?></td>
                                            <td><?php echo $p['name'].' '.$p['surname'] ?></td>
                                            <td><?php echo $p['type'] ?></td>
                                            <td><?php echo $p['dob'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            <? }?>

                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<script>
$(document).ready(function(){
    $('.issue-loading').click(function(){
        $(this).removeClass().addClass('fa fa-spinner fa-spin');
    });
});
</script>
<?php
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();
?>
