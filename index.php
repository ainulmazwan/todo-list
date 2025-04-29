<?php
    $host = "127.0.0.1";
    $database_name = "todolist"; // connect to which database
    $database_user = "root";
    $database_password = "";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, //username
        $database_password //password
    );

    $sql = "SELECT * FROM tasks";
    $query = $database->prepare($sql);
    $query->execute();
    $tasks = $query->fetchAll();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
            <?php foreach ($tasks as $index => $task) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center"
          >
                <div>
                  <!-- complete -->
                  <form method="POST" action="complete_task.php">
                  <input type="hidden" name="completed" value="<?php echo $task["completed"] ?>"/>
                  <input type="hidden" name="id" value="<?php echo $task["id"] ?>"/>
                    <?php if ($task["completed"]==0){ ?>
                      <button class="btn btn-sm btn-light">
                        <i class="bi bi-square"></i>
                        
                      </button>
                      <span class="ms-2 text-start"><?php echo $task["task"]   ?></span>
                    <?php  }else{ ?>
                      <button class="btn btn-sm btn-success">
                        <i class="bi bi-check-square"></i>
                        
                      </button>
                      <s><span class="ms-2 text-start"><?php echo $task["task"]   ?></span></s>
                    <?php } ?>
                    
                  </form>
                </div>
                <div>
                  <!-- delete -->
                  <form method="POST" action="delete_task.php">
                  <input type="hidden" name="id" value="<?php echo $task["id"] ?>"/>
                      <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                </div>

            </li>
            <?php } ?>
            
        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method="POST" action="add_task.php">
            <input
              name="name"
              type="text"
              class="form-control"
              placeholder="Add new item..."
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>