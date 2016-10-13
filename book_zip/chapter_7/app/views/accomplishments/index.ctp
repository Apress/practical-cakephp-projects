<h2>Team Accomplishments</h2>
<p>What have you done?</p>
<?= $form->create('Accomplishment') ?>
<?= $form->input('description') ?>
<?= $form->hidden('team_member', array('value' => $this->params['url']['team_member'])) ?>
<?= $form->submit('Post Accomplishment') ?>
</form>

<h2>My Accomplishments</h2>
   <?php foreach($my_accomplishments as $accomplishment) : ?>
   <p><strong><?= Sanitize::html($accomplishment['Accomplishment']['description']) ?></strong></p>
   <p><small><?= $time->niceShort($accomplishment['Accomplishment']['created']) ?></small></p>
   <br/>
   <?php endforeach; ?>

<h2>Others' Accomplishments</h2>
   <?php foreach($other_accomplishments as $accomplishment) : ?>
   <p><em><?= Sanitize::html($accomplishment['Accomplishment']['team_member']) ?></em>: <strong><?= Sanitize::html($accomplishment['Accomplishment']['description']) ?></strong></p>
   <p><small><?= $time->niceShort($accomplishment['Accomplishment']['created']) ?></small></p>
   <br/>
   <?php endforeach; ?>
