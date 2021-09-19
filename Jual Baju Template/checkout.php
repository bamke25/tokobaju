<div id="checkout">
        <div class="navinfo" id="navinfo">
            <div class="info">
                checkout
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="" class="contentinfo">
            <div class="shoppingcart">
                <table>
                    <tr>
                        <th></th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>size</th>
                        <th>total</th>
                    </tr>

                    <?php for ($i = 0; $i < 2; $i++){ ?>
                    <tr>
                        <td><img src="assets/img/sholat yuuk.jpg" alt="#">
                        </td>
                        <td>30$</td>
                        <td>3</td>
                        <td>L</td>
                        <td>30$</td>
                    </tr>
                    <?php } ?>

                </table>
                <div class="keterangan">
                    <h4>Total: <span>70$</span></h4>
                    <h4>
                        Send To: <br>
                        BNI: 01910191018 <br> Mandiri: 0101009101101 <br> BCA:0109201910
                    </h4>
                </div>
                <div class="actionbutton">
                    <input style="display: none;" class="button" type="file" name="file" id="file" class="inputfile" />
                    <label style="padding: 0 10px 0 10px;" class="button" for="file">upload bukti transfer</label>
                    <button>save</button>
                </div>              
            </div>
        </form>
        </div>