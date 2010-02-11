
<?php if ($this->header): ?>
<div class="header<?php echo $this->classHeader; ?>">
<span class="date"><?php echo $this->firstDate; ?></span><?php if ($this->firstDay): ?> <span class="day">(<?php echo $this->firstDay; ?>)</span><?php endif; ?>  
</div>

<?php endif; ?>
<div class="event<?php echo $this->classList; ?>">
<h2><a href="<?php echo $this->link; ?>" title="<?php echo $this->title; ?> (<?php if ($this->day): echo $this->day; ?>, <?php endif; echo $this->date; if ($this->time): ?>, <?php echo $this->time; endif; ?>)"<?php echo $this->target; ?>><?php echo $this->title; ?></a></h2>
<?php if ($this->time || $this->span): ?>
<p class="time"><?php echo $this->time . $this->span; ?></p>
<?php endif; ?>
<div class="ce_text">
<?php echo $this->details; ?>
</div>
</div>
