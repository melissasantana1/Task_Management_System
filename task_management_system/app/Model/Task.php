<?php

function insert_task($conn, $data){
    // Se due_date vier vazio, converte para NULL
    $due_date = !empty($data[3]) ? $data[3] : null;

    $sql = "INSERT INTO tasks (title, description, assigned_to, due_date, status) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $data[0], // title
        $data[1], // description
        $data[2], // assigned_to
        $due_date, 
        isset($data[4]) ? $data[4] : 'pending' // valor padrão se não for enviado
    ]);

}


function get_all_tasks($conn){
	$sql = "SELECT * FROM tasks ORDER BY id DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else $tasks = 0;

	return $tasks;
}




function get_all_tasks_due_today($conn){
	$sql = "SELECT * FROM tasks WHERE DATE(due_date) = CURDATE() AND status != 'completed' ORDER BY id DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else {
	$tasks = 0;
}
	return $tasks;
}

function count_tasks_due_today($conn){
	$sql = "SELECT COUNT(*) AS total FROM tasks WHERE DATE(due_date) = CURDATE() AND status != 'completed'";
	$stmt = $conn->query($sql);
	$stmt->execute([]);

	return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


function get_all_tasks_overdue($conn){
	$sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status != 'completed' ORDER BY id DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else {
	$tasks = 0;
}
	return $tasks;
}

function count_tasks_overdue($conn){
	$sql = "SELECT COUNT(*) AS total FROM tasks WHERE due_date < CURDATE() AND status != 'completed'";
	  $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function get_all_tasks_NoDeadline($conn){
	$sql = "SELECT * FROM tasks WHERE status != 'completed' AND due_date IS NULL ORDER BY id DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else {
	$tasks = 0;
}
	return $tasks;
}

function count_tasks_NoDeadline($conn){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE   status != 'completed' AND due_date IS NULL";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}



function delete_task($conn, $data){
	$sql = "DELETE FROM tasks WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);

}

function get_task_by_id($conn, $id){
	$sql = "SELECT * FROM tasks WHERE id =?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if($stmt->rowCount() > 0){
		$task = $stmt->fetch();
	}else $task = 0;

	return $task;
}

function count_tasks($conn){
    $sql = "SELECT COUNT(*) AS total FROM tasks";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}


function update_task($conn, $data){
	$sql = "UPDATE tasks SET title=?, description=?, assigned_to=?, due_date=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);

}

function update_task_status($conn, $data){
	$sql = "UPDATE tasks SET status=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);

}

function get_all_tasks_by_id($conn, $id){
	$sql = "SELECT * FROM tasks WHERE assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else $tasks = 0;

	return $tasks;
}

function count_pending_tasks($conn){
	$sql = "SELECT id FROM tasks WHERE status = 'pending'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
} 

function count_in_progress_tasks($conn){
	$sql = "SELECT id FROM tasks WHERE status = 'in_progress'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
} 

function count_completed_tasks($conn){
	$sql = "SELECT id FROM tasks WHERE status = 'completed'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
} 


function count_my_tasks($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}


function count_my_tasks_overdue($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks 
            WHERE due_date < CURDATE() 
            AND status != 'completed' 
            AND assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function count_my_tasks_NoDeadline($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE due_date IS NULL AND assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total'];
}


function count_my_pending_tasks($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE status = 'pending' AND assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}


function count_my_in_progress_tasks($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE status = 'in_progress' AND assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}


function count_my_completed_tasks($conn, $id){
    $sql = "SELECT COUNT(*) AS total FROM tasks WHERE status = 'completed' AND assigned_to=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

