<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220321093431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Асинхронное создание индексов';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX answer_templates__question_template_id__index ON answer_templates (question_template_id)');
        $this->addSql('CREATE INDEX answer__question_id__index ON answers (question_id)');
        $this->addSql('CREATE INDEX IDX_DDDE0E4591CC992 ON course_students (course_id)');
        $this->addSql('CREATE INDEX IDX_DDDE0E4CB944F1A ON course_students (student_id)');
        $this->addSql('CREATE INDEX question_templates__exercise_template_id__index ON question_templates (exercise_template_id)');
        $this->addSql('CREATE INDEX questions__exercise_id__index ON questions (exercise_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX answer_templates__question_template_id__index');
        $this->addSql('DROP INDEX answer__question_id__index');
        $this->addSql('DROP INDEX IDX_DDDE0E4591CC992');
        $this->addSql('DROP INDEX IDX_DDDE0E4CB944F1A');
        $this->addSql('DROP INDEX question_templates__exercise_template_id__index');
        $this->addSql('DROP INDEX questions__exercise_id__index');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
