<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220321091901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание основных таблиц';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_templates (id SERIAL NOT NULL, question_template_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN answer_templates.text IS \'Текст ответа на вопрос\'');
        $this->addSql('CREATE TABLE answers (id SERIAL NOT NULL, question_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN answers.text IS \'Текст ответа на вопрос\'');
        $this->addSql('CREATE TABLE courses (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, course_date_range_start_date DATE NOT NULL, course_date_range_end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN courses.name IS \'Название курса\'');
        $this->addSql('CREATE TABLE course_students (course_id INT NOT NULL, student_id INT NOT NULL, PRIMARY KEY(course_id, student_id))');
        $this->addSql('CREATE TABLE exercise_templates (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, time_to_complete VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN exercise_templates.name IS \'Название упражнения\'');
        $this->addSql('COMMENT ON COLUMN exercise_templates.time_to_complete IS \'Время в секундах на выполнение задания\'');
        $this->addSql('CREATE TABLE exercises (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, time_to_complete VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN exercises.name IS \'Название упражнения\'');
        $this->addSql('COMMENT ON COLUMN exercises.time_to_complete IS \'Время в секундах на выполнение задания\'');
        $this->addSql('CREATE TABLE question_templates (id SERIAL NOT NULL, exercise_template_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN question_templates.text IS \'Текст вопроса\'');
        $this->addSql('CREATE TABLE questions (id SERIAL NOT NULL, exercise_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN questions.text IS \'Текст вопроса\'');
        $this->addSql('CREATE TABLE students (id SERIAL NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE answer_templates ADD CONSTRAINT FK_52D7A258E6DED035 FOREIGN KEY (question_template_id) REFERENCES question_templates (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6061E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course_students ADD CONSTRAINT FK_DDDE0E4591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course_students ADD CONSTRAINT FK_DDDE0E4CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_templates ADD CONSTRAINT FK_66FD391548281F3C FOREIGN KEY (exercise_template_id) REFERENCES exercise_templates (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5E934951A FOREIGN KEY (exercise_id) REFERENCES exercises (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE answer_templates ADD is_right BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN answer_templates.is_right IS \'Является ли этот ответ правильным\'');
        $this->addSql('ALTER TABLE answers ADD is_right BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN answers.is_right IS \'Является ли этот ответ правильным\'');

        $this->addSql('ALTER TABLE students ADD email VARCHAR(255) NOT NULL');
        $this->addSql('COMMENT ON COLUMN students.email IS \'Почта ученика\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_students DROP CONSTRAINT FK_DDDE0E4591CC992');
        $this->addSql('ALTER TABLE question_templates DROP CONSTRAINT FK_66FD391548281F3C');
        $this->addSql('ALTER TABLE questions DROP CONSTRAINT FK_8ADC54D5E934951A');
        $this->addSql('ALTER TABLE answer_templates DROP CONSTRAINT FK_52D7A258E6DED035');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C6061E27F6BF');
        $this->addSql('ALTER TABLE course_students DROP CONSTRAINT FK_DDDE0E4CB944F1A');
        $this->addSql('DROP TABLE answer_templates');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE course_students');
        $this->addSql('DROP TABLE exercise_templates');
        $this->addSql('DROP TABLE exercises');
        $this->addSql('DROP TABLE question_templates');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE students');
    }
}
