<section class="py-3">
    <div class="container">
        <div class="content py-5 px-3 bg-gradient-maroon">
            <h3><b>Список заказов</b></h3>
        </div>
        <div class="row mt-n4 justify-content-center align-items-center flex-column">
            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                <div class="card rounded-0 shadow">
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-stripped table-bordered">
                                <colgroup>
                                    <col width="5%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="p-1 text-center">№</th>
                                        <th class="p-1 text-center">Дата заказа</th>
                                        <th class="p-1 text-center">Номер заказа</th>
                                        <th class="p-1 text-center">Цена</th>
                                        <th class="p-1 text-center">Статус</th>
                                        <th class="p-1 text-center">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    $orders = $conn->query("SELECT * FROM `order_list` where customer_id = '{$_settings->userdata('id')}' order by abs(unix_timestamp(date_created)) desc ");
                                    while($row = $orders->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="p-1 align-middle text-center"><?= $i++ ?></td>
                                        <td class="p-1 align-middle"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                        <td class="p-1 align-middle"><?= $row['code'] ?></td>
                                        <td class="p-1 align-middle text-right"><?= format_num($row['total_amount'],2) ?> BYN</td>
                                        <td class="p-1 align-middle text-center">
                                            <?php 
                                            switch($row['status']){
                                                case 0:
                                                    echo '<span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill">В обработке</span>';
                                                    break;
                                                case 1:
                                                    echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Упакован</span>';
                                                    break;
                                                case 2:
                                                    echo '<span class="badge badge-warning bg-gradient-warning px-3 rounded-pill">В доставке</span>';
                                                    break;
                                                case 3:
                                                    echo '<span class="badge badge-teal bg-gradient-teal px-3 rounded-pill">Выполнен</span>';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td class="p-1 align-middle text-center">
                                            <button class="btn btn-flat btn-sm btn-light border-gradient-light border view-order" type="button" data-id="<?= $row['id'] ?>"><i class="fa fa-eye text-dark"></i> Просмотр</button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('.view-order').click(function(){
            uni_modal("Детали заказа", "orders/view_order.php?id="+$(this).attr('data-id'), 'modal-lg')
        })
    })
</script>