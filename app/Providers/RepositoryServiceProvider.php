<?php

namespace App\Providers;

use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\TableRepositoryInterface;
use App\Interfaces\SectionRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\FacultyRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\LevelRepositoryInterface;
use App\Interfaces\StructureRepositoryInterface;
use App\Interfaces\SpecialtyRepositoryInterface;

use App\Repositories\CourseRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\TableRepository;
use App\Repositories\SectionRepository;
use App\Repositories\RoomRepository;
use App\Repositories\UserRepository;
use App\Repositories\FacultyRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\LevelRepository;
use App\Repositories\StructureRepository;
use App\Repositories\SpecialtyRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(TableRepositoryInterface::class, TableRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(FacultyRepositoryInterface::class, FacultyRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(LevelRepositoryInterface::class, LevelRepository::class);
        $this->app->bind(StructureRepositoryInterface::class, StructureRepository::class);
        $this->app->bind(SpecialtyRepositoryInterface::class, SpecialtyRepository::class);
    }
}
