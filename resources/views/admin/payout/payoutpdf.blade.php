<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Order confirmation </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        margin: 0;
        padding: 0;
        background: #e1e1e1;
    }

    div,
    p,
    a,
    li,
    td {
        -webkit-text-size-adjust: none;
    }

    .ReadMsgBody {
        width: 100%;
        background-color: #ffffff;
    }

    .ExternalClass {
        width: 100%;
        background-color: #ffffff;
    }

    body {
        width: 100%;
        height: 100%;
        background-color: #e1e1e1;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
    }

    html {
        width: 100%;
    }

    p {
        padding: 0 !important;
        margin-top: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0 !important;
    }

    .visibleMobile {
        display: none;
    }

    .hiddenMobile {
        display: block;
    }

    @media only screen and (max-width: 600px) {
        body {
            width: auto !important;
        }

        table[class=fullTable] {
            width: 96% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 45% !important;
        }

        .erase {
            display: none;
        }
    }

    @media only screen and (max-width: 420px) {
        table[class=fullTable] {
            width: 100% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 100% !important;
            clear: both;
        }

        table[class=col] td {
            text-align: left !important;
        }

        .erase {
            display: none;
            font-size: 0;
            max-height: 0;
            line-height: 0;
            padding: 0;
        }

        .visibleMobile {
            display: block !important;
        }

        .hiddenMobile {
            display: none !important;
        }
    }
</style>


<!-- Header -->
<div id="content_printdown">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#e1e1e1">
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td>
                <table width="750" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                    bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                    <tr class="hiddenMobile">
                        <td height="40"></td>
                    </tr>
                    <tr class="visibleMobile">
                        <td height="30"></td>
                    </tr>

                    <tr>
                        <td>
                            <table width="650" border="0" cellpadding="0" cellspacing="0" align="center"
                                class="fullPadding">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                align="left" class="col">
                                                <tbody>
                                                    <tr>
                                                        <td align="left"
                                                            style="font-size: 18px; font-weight: 500; color: #6b10f4; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;"
                                                            width="50%"> <span
                                                                style="display: block; margin-bottom: 5px;">Payout
                                                                Order</span> <strong>#{{ $data->ref_no }}</strong>
                                                        </td>

                                                        <td align="right" style="font-size: 26px;">
                                                            <img src="{{ asset('images/company/logo-lg.jpg') }}"
                                                                width="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="40"></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                            {{-- <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                      <tbody>
                          <tr>
                              <td align="left" style="font-size: 14px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;"><span>Transaction No: </span> #{{$data->transaction->bank_ref}}</td>
                          
                            <td align="left" style="font-size: 14px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                            <span>PR No: </span> #INV-000489
                              </td>
                              <td align="left" style="font-size: 14px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                            <span>Date: </span> 18/04/2024
                              </td>
                        </tr>
                          <tr>
                          <td height="40"></td>
                        </tr>


                      </tbody>
                    </table> --}}
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                align="right" class="col">
                                                <tbody>
                                                    <tr class="visibleMobile">
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="5"></td>
                                                    </tr>

                                                    <td>
                                                        <tr>
                                                            <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top;"
                                                                width="50%">
                                                                <strong>Receiver</strong>
                                                            </td>
                                                            <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;"
                                                                width="50%">
                                                                <strong>Transaction Details</strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                <strong>Customer Name :
                                                                    {{ ucfirst($data->customer->first_name) }}
                                                                    {{ ucfirst($data->customer->last_name) }}</strong>
                                                            </td>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; text-align: right; line-height: 23px;">
                                                                <strong>Amount Transferred :
                                                                    {{ $data->amount }}</strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                Address : {{ $data->customer->address->address_1 }}</td>
                                                            <td width="100"
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; text-align: right; line-height: 23px;">
                                                                Transaction Type: Wallet to Bank Transfer</td>

                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                Phone Number : {{ $data->customer->phone_number }}</td>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                Mode of Payment: {{ strtoupper($data->payment_type) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                Wallet Id : {{ $wallet_id->id }}</td>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                Transaction ID: {{ $data->transaction->bank_ref }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                Status : {{ $data->status }}
                                                            </td>
                                                            <td
                                                                style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                Date &amp; Time {{ $data->updated_at->format('d-m-Y H:i') }}
                                                            </td>
                                                        </tr>
                                                    </td>


                                                </tbody>
                                            </table>
                                        </td>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- /Header -->

    <!-- Information -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#e1e1e1">
        <tbody>
            <tr>
                <td>
                    <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                        <tbody>
                            <tr>
                            <tr class="hiddenMobile">
                                <td height="30"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="40"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="650" border="0" cellpadding="0" cellspacing="0" align="center"
                                        class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="0"
                                                        cellspacing="0" align="left" class="col">

                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="padding-top: 20px; border-top: 1px solid #e4e4e4; font-size: 32px; font-weight: 600;text-align: center; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 20px; vertical-align: top; ">
                                                                    Thank You
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>



                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr class="hiddenMobile">
                                <td height="30"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="30"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- /Information -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</html>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    function printthispage() {
        //var invoiceElement = document.getElementById('invoice');
        //var invoiceNumberWithoutHash = null;

        // if (invoiceElement) {
        //     var invoiceNumberWithHash = invoiceElement.textContent.trim();
        //     invoiceNumberWithoutHash = invoiceNumberWithHash.replace('#', '');
        // }

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var hours = currentDate.getHours().toString().padStart(2, '0');
        var minutes = currentDate.getMinutes().toString().padStart(2, '0');

        var ymdFormat = year + month + day + hours + minutes;
        var filename = "Pres_" + ymdFormat;
        setTimeout(function() {
            exportCanvasAsPdf('content_printdown', filename);
        }, 2000);
       // exportCanvasAsPdf('content_printdown', filename);

    }



    window.jsPDF = window.jspdf.jsPDF;

    function exportCanvasAsPdf(id, fileName) {
        var doc = new jsPDF();



        // Source HTMLElement or a string containing HTML.
        var elementHTML = document.querySelector("#" + id);

        doc.html(elementHTML, {
            callback: function(doc) {
                // Save the PDF


                doc.save(fileName);

                window.close();
            },
            // margin: [5, 5, 5, 5],
            autoPaging: 'text',
            x: 0,
            y: 0,
            width: 190, //target width in the PDF document
            height: 150,
            windowWidth: 675 //window width in CSS pixels
            //window.close();
        });


    }


    printthispage();
</script>
