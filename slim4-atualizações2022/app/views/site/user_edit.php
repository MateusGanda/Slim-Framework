<?php $this->layout('site/master') ?>

<h2>Edit</h2>

<?php if (isset($messages['message'])): ?>
    <div class="alert alert-<?php echo $messages['message']['alert']; ?>">
        <?php echo $messages['message']['message']; ?>
    </div>
<?php endif; ?>

<form action="/user/update/<?= $user->id ?>" method="post">
  <input type="hidden" name="id" value="<?= $user->id ?>" />
  <input type="hidden" name="_METHOD" value="PUT" />

  <div class="form-group">
    <label for="firstName">First Name</label>
    <input
      type="text"
      name="firstName"
      class="form-control"
      value="<?php echo htmlspecialchars($user->firstName); ?>"
    />
    <?php echo getFlash('firstName'); ?>
  </div>

  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input
      type="text"
      name="lastName"
      class="form-control"
      value="<?php echo htmlspecialchars($user->lastName); ?>"
    />
    <?php echo getFlash('lastName'); ?>
    <?php if (isset($messages['lastName'])): ?>
        <div class="alert alert-<?php echo $messages['lastName']['alert']; ?>">
            <?php echo $messages['lastName']['message']; ?>
        </div>
    <?php endif; ?>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input
      type="text"
      name="email"
      class="form-control"
      value="<?php echo htmlspecialchars($user->email); ?>"
    />
    <?php echo getFlash('email'); ?>
    <?php if (isset($messages['email'])): ?>
        <div class="alert alert-<?php echo $messages['email']['alert']; ?>">
            <?php echo $messages['email']['message']; ?>
        </div>
    <?php endif; ?>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input
      type="password"
      name="password"
      class="form-control"
      value="<?php echo htmlspecialchars($user->password); ?>"
    />
    <?php echo getFlash('password'); ?>
    <?php if (isset($messages['password'])): ?>
        <div class="alert alert-<?php echo $messages['password']['alert']; ?>">
            <?php echo $messages['password']['message']; ?>
        </div>
    <?php endif; ?>
  </div>

  <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
