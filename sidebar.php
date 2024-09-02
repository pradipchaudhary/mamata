<aside class="site-sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <p><?php _e('Add widgets here.', 'mamata-beauty-salon'); ?></p>
    <?php endif; ?>
</aside>
