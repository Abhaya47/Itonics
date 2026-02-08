<?php
// Connect to database
include 'config/database.php';

// Load all helper functions (CRUD operations, dashboard counts)
include 'includes/functions.php';

// Load header (navbar, CSS styles, HTML head)
include 'includes/header.php';

// Get total counts for dashboard cards
$total_students = getTotalStudents($conn);       // Count all students
$total_courses = getTotalCourses($conn);         // Count all courses
$total_enrollments = getTotalEnrollments($conn); // Count all enrollments

// Get last 5 enrollments for the recent activity table
$recent_enrollments = getRecentEnrollments($conn, 5);
?>

<!-- Dashboard Title -->
<h2>Dashboard for Student Course Enrollment System</h2>

<!-- Stats Cards - Shows total counts, each card links to its section -->
<div style="display:flex; gap:20px; flex-wrap:wrap; margin-bottom:30px;">

    <!-- Students Card - Blue -->
    <a href="students/index.php" style="flex:1; min-width:200px; padding:25px; background:#3498db; color:white; border-radius:8px; text-align:center; text-decoration:none;">
        <div style="font-size:36px; font-weight:bold;"><?php echo $total_students; ?></div>
        <div style="margin-top:8px;">👨‍🎓 Total Students</div>
    </a>

    <!-- Courses Card - Green -->
    <a href="courses/index.php" style="flex:1; min-width:200px; padding:25px; background:#27ae60; color:white; border-radius:8px; text-align:center; text-decoration:none;">
        <div style="font-size:36px; font-weight:bold;"><?php echo $total_courses; ?></div>
        <div style="margin-top:8px;">📖 Total Courses</div>
    </a>

    <!-- Enrollments Card - Purple -->
    <a href="enrollments/index.php" style="flex:1; min-width:200px; padding:25px; background:#8e44ad; color:white; border-radius:8px; text-align:center; text-decoration:none;">
        <div style="font-size:36px; font-weight:bold;"><?php echo $total_enrollments; ?></div>
        <div style="margin-top:8px;">📋 Total Enrollments</div>
    </a>
</div>

<!-- Recent Enrollments Section -->
<h2>Recent Enrollments</h2>

<?php if (mysqli_num_rows($recent_enrollments) > 0): // Check if there are any enrollments ?>

<!-- Table to display recent enrollments -->
<table>
    <tr>
        <th>#</th>           <!-- Row number -->
        <th>Student</th>     <!-- Student name from JOIN -->
        <th>Course</th>      <!-- Course name from JOIN -->
        <th>Date</th>        <!-- Enrollment date -->
    </tr>
    <?php $i = 1; while ($row = mysqli_fetch_assoc($recent_enrollments)): // Loop through each enrollment ?>
    <tr>
        <td><?php echo $i++; ?></td>                                                  <!-- Row counter -->
        <td><?php echo $row['student_name']; ?></td>                                  <!-- Student name -->
        <td><?php echo $row['course_name']; ?></td>                                   <!-- Course name -->
        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>         <!-- Format date like "Feb 08, 2026" -->
    </tr>
    <?php endwhile; ?>
</table>

<?php else: // No enrollments found ?>
<p>No enrollments yet. <a href="enrollments/create.php">Create one</a></p>
<?php endif; ?>

<!-- Load footer (closing HTML tags) -->
<?php include 'includes/footer.php'; ?>