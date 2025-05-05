<?php

    $database = connectToDB();

    $sql = "SELECT * FROM tasks";
    $query = $database->prepare($sql);
    $query->execute();
    $tasks = $query->fetchAll();

?>
<?php require "parts/header.php"; ?>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <?php if (isset($_SESSION["user"])): ?>
          <p>Hello, <?= $_SESSION["user"]["name"]; ?></p>
          <ul class="list-group">
            <?php foreach ($tasks as $index => $task) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center"
          >
                <div>
                  <!-- complete -->
                  <form method="POST" action="/task/complete">
                  <input type="hidden" name="completed" value="<?php echo $task["completed"] ?>"/>
                  <input type="hidden" name="id" value="<?php echo $task["id"] ?>"/>
                    <?php if ($task["completed"]==0){ ?>
                      <?php if (isset($_SESSION["user"])): ?>
                        <button class="btn btn-sm btn-light">
                          <i class="bi bi-square"></i>
                        </button>
                      <?php else: ?>
                        <button class="btn btn-sm btn-light" disabled>
                          <i class="bi bi-square"></i>
                        </button>
                      <?php endif; ?>
                      <span class="ms-2 text-start"><?php echo $task["task"]   ?></span>
                    <?php  }else{ ?>
                      <?php if (isset($_SESSION["user"])): ?>
                        <button class="btn btn-sm btn-success">
                          <i class="bi bi-check-square"></i>
                        </button>
                      <?php else: ?>
                        <button class="btn btn-sm btn-success" disabled>
                          <i class="bi bi-check-square"></i>
                        </button>
                      <?php endif; ?>
                      <s><span class="ms-2 text-start"><?php echo $task["task"]   ?></span></s>
                    <?php } ?>
                    
                  </form>
                </div>
                <div>
                  <!-- delete -->
                  <?php if (isset($_SESSION["user"])): ?>
                    <form method="POST" action="/task/delete">
                      <input type="hidden" name="id" value="<?php echo $task["id"] ?>"/>
                      <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  <?php endif; ?>
                </div>

            </li>
            <?php } ?>
            
        </ul>
        <div class="mt-4">
          <?php if (isset($_SESSION["user"])): ?>
            <form class="d-flex justify-content-between align-items-center" method="POST" action="/task/add">
              <input
                name="name"
                type="text"
                class="form-control"
                placeholder="Add new item..."
                required
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </form>
          <?php endif; ?>
        </div>
        <!-- if user is not logged in -->
        <?php else:  ?>
          <div>
            <a href="/login">Login</a>
            <a href="/signup">Sign Up</a>
          </div>

        <?php endif; ?>
        
      </div>
    </div>
    <?php if (isset($_SESSION["user"])): ?>
      <div class="text-center">
        <a href="/logout">Log Out</a>
      </div>
    <?php endif; ?>
<?php require "parts/footer.php"; ?>