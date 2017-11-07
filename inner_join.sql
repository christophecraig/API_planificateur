SELECT efficiency.efficiency, skills.name
FROM skills INNER JOIN efficiency
WHERE efficiency.resource_id = 4;