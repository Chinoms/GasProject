<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 60mm;
        background: #FFF;


        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 100px;
        }

        #mid {
            min-height: 80px;
        }

        #bot {
            min-height: 50px;
        }

        #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;
            margin-left: 0;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabletitle {
            font-size: .5em;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: .5em;
        }

        #legalcopy {
            margin-top: 5mm;
        }



    }
</style>
<script>
    function printInfo(ele) {
        var openWindow = window.open("", "title", "attributes");
        openWindow.document.write(ele.previousSibling.innerHTML);
        openWindow.document.close();
        openWindow.focus();
        openWindow.print();
        // openWindow.close();
    }
</script>





<div id="hello">
    <div>
    <div id="invoice-POS">
    <center id="top">
        <div class="logo"></div>
        <div class="info">
            <h2>METRO GAS</h2>
        </div>
        <!--End Info-->
    </center>
    <!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <!--h2>Contact Info</h2-->
            <p>
                Address : No. 3 Farm Road, Igwuruta-Ali</br>
                Email : info@metrogas.com</br>
                Phone : 08099008877</br>
            </p>
        </div>
    </div>
    <!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item">
                        <h4>Item</h4>
                    </td>
                    <td class="Hours">
                        <h4>Qty</h4>
                    </td>
                    <td class="Rate">
                        <h4>Sub Total</h4>
                    </td>
                </tr>

                <tr class="service">
                    <td class="tableitem">
                        <p class="itemtext">Cooking gas</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">{{ $quantity }}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">#{{ number_format($cost) }}</p>
                    </td>
                </tr>




                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Total</h2>
                    </td>
                    <td class="payment">
                        <h2>#{{ number_format($cost) }}</h2>
                    </td>
                </tr>

            </table>
            <strong>Rate: </strong> {{ $rate }}/kg<br>
            <strong>Coupon code:</strong> {{$coupon}}<br>
            <strong>Cashier:</strong> {{ $cashier }}
        </div>
        <!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank you for your patronising us!</strong></p>
        </div>

    </div>
    <!--End InvoiceBot-->
</div>
<!--End Invoice-->
    </div><a href="#" onclick="printInfo(this)"><button>Print</button></a>
    <a href="{{route('pos')}}"><button>Go back</button></a>
</div>
