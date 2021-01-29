<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
</head>

<body>
<style>
    /* -------------------------------------
        GLOBAL RESETS
    ------------------------------------- */
    img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%;
    }

    body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%;
    }

    table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: top;
    }

    /* -------------------------------------
        BODY & CONTAINER
    ------------------------------------- */

    .body {
        background-color: #f6f6f6;
        width: 100%;
    }

    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 640px;
        padding: 10px;
        width: 640px;
    }

    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 640px;
        padding: 10px;
    }

    /* -------------------------------------
        HEADER, FOOTER, MAIN
    ------------------------------------- */
    .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%;
    }

    .wrapper {
        box-sizing: border-box;
        padding: 30px 20px;
    }

    .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%;
    }

    .footer td,
    .footer p,
    .footer span,
    .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
    }

    /* -------------------------------------
        TYPOGRAPHY
    ------------------------------------- */
    h1,
    h2,
    h3,
    h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px;
    }

    h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize;
    }

    p,
    ul,
    ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px;
    }

    p li,
    ul li,
    ol li {
        list-style-position: inside;
        margin-left: 5px;
    }

    a {
        color: #3498db;
        text-decoration: underline;
    }

    /* -------------------------------------
        BUTTONS
    ------------------------------------- */
    .btn {
        box-sizing: border-box;
        width: 100%;
    }

    .btn > tbody > tr > td {
        padding-bottom: 15px;
    }

    .btn table {
        width: auto;
    }

    .btn table td {
        background-color: #ffffff;
        border-radius: 5px;
        text-align: center;
    }

    .btn a {
        background-color: #ffffff;
        border: solid 1px #3498db;
        border-radius: 5px;
        box-sizing: border-box;
        color: #3498db;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        padding: 12px 25px;
        text-decoration: none;
        text-transform: capitalize;
    }

    .btn-primary table td {
        background-color: #3498db;
    }

    .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff;
    }

    /* -------------------------------------
        OTHER STYLES THAT MIGHT BE USEFUL
    ------------------------------------- */
    .last {
        margin-bottom: 0;
    }

    .first {
        margin-top: 0;
    }

    .align-center {
        text-align: center;
    }

    .align-right {
        text-align: right;
    }

    .align-left {
        text-align: left;
    }

    .clear {
        clear: both;
    }

    .mt0 {
        margin-top: 0;
    }

    .mb0 {
        margin-bottom: 0;
    }

    .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0;
    }

    .powered-by a {
        text-decoration: none;
    }

    hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0;
    }

    /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
    @media only screen and (max-width: 620px) {
        table[class=body] h1 {
            font-size: 28px !important;
            margin-bottom: 10px !important;
        }

        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
            font-size: 16px !important;
        }

        table[class=body] .wrapper,
        table[class=body] .article {
            padding: 10px !important;
        }

        table[class=body] .content {
            padding: 0 !important;
        }

        table[class=body] .container {
            padding: 0 !important;
            width: 100% !important;
        }

        table[class=body] .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }

        table[class=body] .btn table {
            width: 100% !important;
        }

        table[class=body] .btn a {
            width: 100% !important;
        }

        table[class=body] .img-responsive {
            height: auto !important;
            max-width: 100% !important;
            width: auto !important;
        }
    }

    /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important;
        }

        .btn-primary table td:hover {
            background-color: #34495e !important;
        }

        .btn-primary a:hover {
            background-color: #34495e !important;
            border-color: #34495e !important;
        }
    }
</style>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tbody>
    	<tr>
	        <td>&nbsp;</td>
	        <td class="container">
	            <div class="content">
	                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
	                    <tbody>
		                	<tr>
		                        <td style="text-align: center;">
		                            <div style="height: 70px;width:100%;text-align: center;margin-bottom: 10px;">
		                                <a href="<?= base_url(); ?>">
		                                    <img src="<?= base_url($this->general_settings['logo']); ?>" alt="<?= $this->general_settings['application_name']; ?>" style="max-width: 180px;max-height: 70px;">
		                                </a>
		                            </div>
		                        </td>
		                    </tr>
	                	</tbody>
	            	</table>    <!-- START CENTERED WHITE CONTAINER -->
				    
				    <table role="presentation" class="main">
				        <!-- START MAIN CONTENT AREA -->
				        <tbody>
				        	<tr>
					            <td class="wrapper">
					                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
					                    <tbody><tr>
					                        <td>
					                            <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= $head ?></h1>
					                            <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
					                                <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
					                                    <p><?= $content ?></p>
					                                </div>
					                            </div>
					                        </td>
					                    </tr>
					                </tbody></table>
					            </td>
				        	</tr>
				        <!-- END MAIN CONTENT AREA -->
				    	</tbody>
				    </table>

                    Hello,<div><br>Thank you for signing up with us<br><br>To activate your account and verify your email address,<br><br></div><div>Please click on link bellow <br>{<a target="_blank" rel="nofollow" href="http://bftechlab.net/jobslist/" title="Link: http://bftechlab.net/jobslist/">http://bftechlab.net/jobslist/</a>
}<br><a target="" rel=""></a></div><div><a target="" rel=""><br></a></div><div><a target="" rel=""><br></a></div><div><a target="" rel="">Regards,<br>Team Onjob</a></div>

				    <!-- SOCIAL LINKS -->
					<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
					    <tbody>
					    	<tr>
						        <td class="content-block" style="text-align: center;width: 100%;">
					                <a href="<?= $this->general_settings['facebook_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>facebook.png" alt="" style="width: 28px; height: 28px;">
					                </a>

					                <a href="<?= $this->general_settings['twitter_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>twitter.png" alt="" style="width: 28px; height: 28px;">
					                </a>

	                                <a href="<?= $this->general_settings['instagram_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>instagram.png" alt="" style="width: 28px; height: 28px;">
					                </a>

	                                <a href="<?= $this->general_settings['linkedin_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>linkedin.png" alt="" style="width: 28px; height: 28px;">
					                </a>
	                                
	                                <a href="<?= $this->general_settings['youtube_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>youtube.png" alt="" style="width: 28px; height: 28px;">
					                </a>

					                <a href="<?= $this->general_settings['google_link'] ?>" target="_blank" style="color: transparent;margin-right: 5px;">
					                    <img src="<?= base_url('assets/dist/img/') ?>google.png" alt="" style="width: 28px; height: 28px;">
					                </a>
					            </td>
						    </tr>
						</tbody>
					</table>

					<!-- START FOOTER -->
					<div class="footer">
					    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
					        <tbody><tr>
					            <td class="content-block powered-by">
					                <?= $this->general_settings['copyright']; ?>      
					            </td>
					        </tr>
					       
					    </tbody></table>
					</div>
					<!-- END FOOTER -->

				<!-- END CENTERED WHITE CONTAINER -->
				</div>
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

</body>
</html>