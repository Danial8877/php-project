<!-- Footer Section -->
<footer class="text-center pt-4 my-md-5 pt-md-5 border-top">
    <div class="row flex-column">
        <div>
            <p class="">
                <?php
                $settings = $db->prepare('SELECT * FROM settings WHERE id = :id');
                $settings->execute(["id" => "1"]);
                foreach ($settings as $setting) :
                ?>
                    <?= $setting["title_footer"]; ?>
                <?php endforeach; ?>
            </p>
        </div>
        <div>
            <a href="#"><i
                    class="bi bi-telegram fs-3 text-secondary ms-2"></i></a>
            <a href="#"><i
                    class="bi bi-whatsapp fs-3 text-secondary ms-2"></i></a>
            <a href="#"><i class="bi bi-instagram fs-3 text-secondary"></i></a>
        </div>
    </div>
</footer>
</div>
<script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>