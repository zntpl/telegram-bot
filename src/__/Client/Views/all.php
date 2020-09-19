
<div class="col-md-12">
    <?php foreach ($all as $entity) { ?>
        <div class="alert alert-<?= $entity['chat_id'] == $botId ? 'primary' : 'success' ?>" role="alert">
            <div  class="<?= $entity['chat_id'] == $botId ? '' : 'float-' ?>">
                <?= $entity['text'] ?>
            </div>
        </div>
    <?php } ?>
</div>
