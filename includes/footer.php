<style>
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .footer-section {
        margin-bottom: 20px;
    }

    .footer-section h3 {
        margin-bottom: 10px;
    }

    .footer-section a {
        color: #fff;
        text-decoration: none;
    }

    .footer-section a:hover {
        text-decoration: underline;
    }
</style>
<footer class="bg-dark">
    <div class="footer-content">
        <table class="table table-dark">
            <tr>
                <td align="left"><div class="footer-section">
                        <h3>Contact Us</h3>
                        <p>Email: info@yourpetstore.com</p>
                        <p>Phone: (123) 456-7890</p>
                    </div></td>
                <td align="left" class=""><div class="footer-section">
                        <h3>Follow Us</h3>
                        <a href="#" target="_blank">Facebook</a><br>
                        <a href="#" target="_blank">Twitter</a><br>
                        <a href="#" target="_blank">Instagram</a>
                    </div></td>
                <td align="left" class=""><div class="footer-section">
                        <h3>Quick Links</h3>
                        <a href="#">Home</a><br>
                        <a href="#">Shop</a><br>
                        <a href="#">About Us</a><br>
                        <a href="#">Contact</a>
                    </div></td>
                <td align="left" class="float-end"><div class="footer-section">
                        <h3>Quick Links</h3>
                        <a href="#">Home</a><br>
                        <a href="#">Shop</a><br>
                        <a href="#">About Us</a><br>
                        <a href="#">Contact</a>
                    </div></td>
            </tr>
        </table>
    </div>
    <p>&copy; 2023 Your Pet Store. All rights reserved.</p>
</footer>
<script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="assets/js/custom.js"></script>
    <script>
        alertify.set('notifier','position', 'top-right');

        <?php
        if(isset($_SESSION['msg']))
        {
        ?>
            alertify.success('<?= $_SESSION['msg']?>');
        <?php
        }
        unset($_SESSION['msg']);
        ?>
    </script>
    </main>
    </html>
