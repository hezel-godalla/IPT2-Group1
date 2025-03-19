<?php
  include('database/database.php');
  include('partials/header.php');
  include('partials/sidebar.php');

  // Pagination variables
  $limit = 5; // Number of records per page
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
  $offset = ($page - 1) * $limit; // Offset for SQL query

  // Search functionality
  $search = "";
  if (isset($_GET['search'])) {
      $search = $_GET['search'];
  }

  // Build SQL query with pagination and search functionality
  if (!empty($search)) {
      $sql = "SELECT * FROM celebrities
              WHERE Nam LIKE '%$search%' 
              OR Age LIKE '%$search%' 
              OR Gender LIKE '%$search%' 
              OR Occupation LIKE '%$search%'
              LIMIT $offset, $limit";
  } else {
      $sql = "SELECT * FROM celebrities LIMIT $offset, $limit";
  }

  // Debugging: Print the SQL query
  echo $sql; // This will help you see the actual query being executed

  // Execute the query
  $result = $conn->query($sql);

  // Check for errors in the query execution
  if (!$result) {
      die("Query failed: " . $conn->error);
  }

  // Get total records for pagination (with or without search)
  $total_sql = "SELECT COUNT(*) as total FROM celebrities";
  if (!empty($search)) {
      $total_sql = "SELECT COUNT(*) as total FROM celebrities 
                    WHERE Nam LIKE '%$search%' 
                    OR Age LIKE '%$search%' 
                    OR Gender LIKE '%$search%' 
                    OR Occupation LIKE '%$search%'";
  }

  // Get the total number of records
  $total_result = $conn->query($total_sql);
  $total_row = $total_result->fetch_assoc();
  $total_records = $total_row['total'];
  $total_pages = ceil($total_records / $limit);

  $sql = "SELECT * FROM celebrities LIMIT $limit OFFSET $offset";
  $result = $conn->query($sql);

  if (!empty($_GET['search'])) {
      $search = $_GET['search'];
      $sql = "SELECT * FROM celebrities WHERE Nam LIKE '%$search%' OR Age LIKE '%$search%' OR Gender LIKE '%$search%' OR Occupation LIKE '%$search%'";
  }
  
  $celebrities = $conn->query($sql);  
  $status = '';
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
  }
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Celebrities Information Management System</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">General</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Celebrities List</h5>
              <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addCelebritiesModal">Add Celebrities</button>
            </div>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Occupation</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($celebrities->num_rows > 0): ?>
                  <?php while ($row = $celebrities->fetch_assoc()): ?>
                    <tr>
                    <th scope= "row" ><?php echo $row['id']; ?></th>
                      <td><?php echo $row['Nam']; ?></td>
                      <td><?php echo $row['Age']; ?></td>
                      <td><?php echo $row['Gender']; ?></td>
                      <td><?php echo $row['Occupation']; ?></td>
                      <td class="d-flex justify-content-center">
                        <!-- Edit Button -->
                        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Celebrities</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="database/update.php" method="POST">
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="Nam" class="form-control" value="<?php echo $row['Nam']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="text" name="Age" class="form-control" value="<?php echo $row['Age']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <input type="text" name="Gender" class="form-control" value="<?php echo $row['Gender']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" name="Occupation" class="form-control" value="<?php echo $row['Occupation']; ?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>


                            <!-- View Button -->
                            <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#ViewModal<?php echo $row['id']; ?>">View</button>

                            <!-- View Modal -->
                            <div class="modal fade" id="ViewModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">View Celebrity Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Nam']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Age']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Gender']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Occupation']; ?>" disabled>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>


                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                <h1 class="text-danger" style="font-size: 50px"><strong>!</strong></h1>
                                <h5>Are you sure you want to delete this book?</h5>
                                <h6>This action cannot be undone.</h6>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                <form action="database/delete.php" method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No Celebrities found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>

<!-- Pagination Links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
        </li>
    </ul>
</nav>

</main><!-- End #main -->

                        <!-- Create (Add Celebrities) Modal -->
                        <div class="modal fade" id="addcelebritiesModal" tabindex="-1" aria-labelledby="addCelebritiesLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <form action="database/create.php" method="POST">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Add Celebrities</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <div class="mb-3">
                                  <label class="form-label">Name</label>
                                  <input type="text" name="Nam" id="Nam" class="form-control" placeholder="Enter Name" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Age</label>
                                <input type="text" name="Age" id="Age" class="form-control" placeholder="Enter Age"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" name="Gender" id="Gender" class="form-control" placeholder="Enter Gender"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Occupation</label>
                                <input type="text" name="Occupation" id="Occupation" class="form-control" placeholder="Enter Occupation"required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add Celebrity</button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>

                
                



<?php include('partials/footer.php'); ?>
