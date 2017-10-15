# Получить список офисов (offices), в которых находится более четырех сотрудников (employees).
# Получить список заказаов (orders), в которых было заказано более 10 товаров.
# Получить полный список сотрудников (employees), для каждого сотрудника получить количество привязанных к нему покупателей (customers).
# *7. Получить список офисов (offices), для каждого из них получить количество заказов за 2005 год. Выводить толко те офисы, в которых было сделано более 5 заказов.
#
# *8. Получить список типов товаров (productlines), для каждого из них вывести количество заказов, в которых присутствуют товары с этим типом.

# 1
# SELECT * FROM employees WHERE firstName IN ("Barry", "Larry", "Leslie") ORDER BY firstName;

# 2
# SELECT * FROM products ORDER BY buyPrice DESC LIMIT 3;

# 3
# SELECT * FROM products ORDER BY quantityInStock LIMIT 3;

# 4
SELECT offices. *,
  count(employees.employeeNumber) AS employees_counter
FROM offices
  INNER JOIN employees ON offices.officeCode = employees.officeCode
GROUP BY offices.officeCode
HAVING employees_counter > 4;
