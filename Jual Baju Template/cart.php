<div id="cart">
        <div class="navinfo" id="navinfo">
            <div class="info">
                cart
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
                        <td><img src="assets/img/sholat yuuk.jpg" alt="#"> <a href="">remove</a>
                        </td>
                        <td>30$</td>
                        <td><input type="number" value="1"/></td>
                        <td>
                        <select name="" id="">
                            <option value="">M</option>
                            <option value="">L</option>
                            <option value="">XL</option>
                        </select></td>
                        <td>30$</td>
                    </tr>
                    <?php } ?>

                </table>
                <div class="keterangan">
                        <select name="kurir" id="kurir">
                            <option value="">Pilih Kurir</option>
                            <option value="">JNE</option>
                            <option value="">JNT</option>
                        </select></td>
                </div>
                <div class="actionbutton">
                    <a class="button" href="#">Update</a>
                    <a class="button" href="#tujuan">next</a>
                </div>
            </div>
        </form>
        </div>