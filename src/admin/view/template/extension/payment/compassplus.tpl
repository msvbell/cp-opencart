<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-compassplus" class="btn btn-primary"><i
                            class="fa fa-save"></i> <?php echo $button_save; ?></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i
                            class="fa fa-reply"></i> <?php echo $button_cancel; ?></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"
                      id="form-compassplus" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-merchant-id"><?php echo $entry_merchant_id; ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="compassplus_merchant_account_id"
                                   value="<?php echo $compassplus_merchant_account_id; ?>"
                                   placeholder="<?php echo $entry_merchant_id; ?>" id="input-merchant-id"
                                   class="form-control"/>
                            <?php if ($error_merchant_id) { ?>
                            <div class="text-danger"><?php echo $error_merchant_id; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="textarea-root-cert"><?php echo $entry_root_cert; ?></label>

                        <div class="col-sm-10">
                            <textarea name="compassplus_root_cert"
                                      placeholder="<?php echo $entry_root_cert; ?>" id="textarea-root-cert"
                                      class="form-control" rows="3"><?php echo $compassplus_root_cert; ?></textarea>
                            <?php if ($error_root_cert) { ?>
                            <div class="text-danger"><?php echo $error_root_cert; ?></div>
                            <?php } ?>
                        </div>
                    </div>
{*                    client cert*}
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="textarea-client-cert"><?php echo $entry_client_cert; ?></label>

                        <div class="col-sm-10">
                            <textarea name="compassplus_client_cert"
                                      placeholder="<?php echo $entry_root_cert; ?>" id="textarea-client-cert"
                                      class="form-control" rows="3"><?php echo $compassplus_client_cert; ?></textarea>
                            <?php if ($error_client_cert) { ?>
                            <div class="text-danger"><?php echo $error_client_cert; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-secret-key"><?php echo $entry_secret_key; ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="compassplus_secret_key" value="<?php echo $compassplus_secret_key; ?>"
                                   placeholder="<?php echo $entry_secret_key; ?>" id="input-secret-key"
                                   class="form-control"/>
                            <?php if ($error_secret_key) { ?>
                            <div class="text-danger"><?php echo $error_secret_key; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                      title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>

                        <div class="col-sm-10">
                            <input type="text" name="compassplus_total" value="<?php echo $compassplus_total; ?>"
                                   placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-order-status"><?php echo $entry_order_status; ?></label>

                        <div class="col-sm-10">
                            <select name="compassplus_order_status_id" id="input-order-status" class="form-control">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $compassplus_order_status_id) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>

                        <div class="col-sm-10">
                            <select name="compassplus_geo_zone_id" id="input-geo-zone" class="form-control">
                                <option value="0"><?php echo $text_all_zones; ?></option>
                                <?php foreach ($geo_zones as $geo_zone) { ?>
                                <?php if ($geo_zone['geo_zone_id'] == $compassplus_geo_zone_id) { ?>
                                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"
                                        selected="selected"><?php echo $geo_zone['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>

                        <div class="col-sm-10">
                            <select name="compassplus_status" id="input-status" class="form-control">
                                <?php if ($compassplus_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_debug; ?>"><?php echo $entry_debug; ?></span></label>
                        <div class="col-sm-10">
                            <select name="compassplus_test" id="input-debug" class="form-control">
                                <?php if ($compassplus_test) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>