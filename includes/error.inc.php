<div class="container">
    <?php if(isset($error_message)): ?>
        <div class="error_message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if(isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>