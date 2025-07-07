# Quiz-School (Teacher Panel)

This is the teacher/admin module of the **Quiz-School.uz** platform. It enables teachers to create, upload, manage, and review electronic tests, replacing the traditional paper-based testing process in schools.

---

## 🧩 Problem It Solves

In many schools, midterm exams are conducted on paper. Teachers must prepare and print each test, distribute and collect answer sheets, and then manually check them. This process requires significant **time, energy, and resources**.

---

## ✅ Our Solution

Quiz-School provides a fully digital two-module solution:

### 👨‍🏫 Teacher Panel (this module)
- Teachers register and log in to the system.
- They create tests in Excel format and upload them to the platform.
- The system automatically reads the Excel file and converts it into quiz questions.
- Uploaded tests are listed in the "My Tests" section.
- Teachers can view which students have completed each test.
- Detailed results for each student can be accessed, including correct/incorrect answers and statistics.

### 🧑‍🎓 Student Panel (Separate Module)
- Students take the uploaded tests online.
- Their results are evaluated instantly.
- Full test history and performance breakdowns are available.

🔗 [Student Panel GitHub Repository](https://github.com/Azizbekutkirovich/Quiz-school)

---

## ⚙️ Tech Stack

- PHP (Yii2 Basic)
- MySQL
- PHPExcel / PhpSpreadsheet
- Bootstrap
- jQuery / AJAX

---

## 🚀 How to Run Locally

Run the following commands in your terminal:

```bash
git clone https://github.com/Azizbekutkirovich/Quiz-school-teacher.git
cd quiz-school-teacher
composer install
# Configure database in config/db.php
php yii migrate
php yii serve

## 📁 Related Projects

- [Quiz-School Student Panel](https://github.com/Azizbekutkirovich/Quiz-school) – Used by students to take tests and view results.

---

## 👤 Author

Created by [Azizbek Utkirovich](https://github.com/Azizbekutkirovich)

📧 Email: azizbek250607@gmail.com