<form method="POST">
    <input type="hidden" name="id" value="<?php echo isset($user['id_u']) ? $user['id_u'] : ''; ?>" />
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($user['nom']) ? $user['nom'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo isset($user['tel']) ? $user['tel'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" class="form-control" value="<?php echo isset($user['age']) ? $user['age'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" class="form-control">
            <option value="M" <?php echo isset($user['genre']) && $user['genre'] === 'M' ? 'selected' : ''; ?>>Male</option>
            <option value="F" <?php echo isset($user['genre']) && $user['genre'] === 'F' ? 'selected' : ''; ?>>Female</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
