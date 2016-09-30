$returned_tasks = $GLOBALS['DB']->query("SELECT tasks.* FROM categories
                JOIN categories_tasks ON (categories_tasks.category_id = categories.id)
                JOIN tasks ON (tasks.id = categories_tasks.task_id)
                WHERE categories.id = {$this->getId()};");
