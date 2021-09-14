<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.janushenderson.com/
 * @since      1.0.0
 *
 * @package    Jh_Nyt_Top_Stories
 * @subpackage Jh_Nyt_Top_Stories/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
 * get settings from wp_options
 */

// save data
if ( isset( $_POST["save_data"] ) ) {
    Jh_Nyt_Top_Stories_Admin::save_option(
        array(
            "api_key" => $_POST["api_key"],
            "cron_enable" => isset( $_POST["cron_enable"] ) ? 1 : '',
            "cron_hour" => $_POST["cron_hour"],
        )
    );
} else if ( isset( $_POST["import"] ) ) {
    $imported = Jh_Nyt_Top_Stories_Admin::import_stories();

    if ( $imported ) {
        echo "<div class='notice notice-success is-dismissible'><p>" . __( 'Imported top stories successfully.', 'jh-nyt-top-stories' ) . "</p></div>";    
    } else {
        echo "<div class='notice notice-error is-dismissible'><p>" . __( 'Error: Please check the api key or internet.', 'jh-nyt-top-stories' ) . "</p></div>";   
    }
}

$api_key = Jh_Nyt_Top_Stories_Admin::get_option( "api_key" );
$cron_enable = Jh_Nyt_Top_Stories_Admin::get_option( "cron_enable" );
$cron_hour = Jh_Nyt_Top_Stories_Admin::get_option( "cron_hour" );

?>

<style type="text/css">
    input[name="cron_hour"] {
        display: none;
    }

    input[name="cron_enable"]:checked+input[name="cron_hour"] {
        display: inline-block;
    }

    .form-table {
        max-width: 600px;
        width: 100%;
    }

    .form-table input[type="text"] {
        width: 100%;
    }

    .form-table input[name="cron_hour"] {
        width: calc(100% - 30px);
    }
</style>

<div class="wrap">
    <h2>
        Settings
    </h2>

    <form method="post" action="" class="license-form">
        <table class="form-table license-tbl">
            <tbody>
                <tr valign="top">
                    <th class="licenseTable" scope="row" valign="top">
                        <?php _e( 'NYT API Key', 'jh-nyt-top-stories' ); ?>
                    </th>
                    <td>
                        <input type="text" name="api_key" value="<?php echo $api_key; ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th class="cronjob" scope="row" valign="top">
                        <?php _e( 'Cron Job', 'jh-nyt-top-stories' ); ?>
                    </th>
                    <td>
                        <input type="checkbox" name="cron_enable" <?php echo $cron_enable ? "checked=checked" : ""; ?> value="1" />
                        <input type="text" name="cron_hour" value="<?php echo $cron_hour; ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" valign="top">
                        <input type="submit" class="button-primary" name="save_data" value="<?php _e( 'Save', 'jh-nyt-top-stories' ) ?>" />
                        <input type="submit" class="button-secondary" id="nyt-import" name="import" value="<?php _e( 'Import', 'jh-nyt-top-stories' ) ?>" />
                    </th>
                </tr>
            </tbody>
        </table>
    </form>
</div>