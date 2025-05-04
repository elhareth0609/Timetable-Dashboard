<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseModel;
use App\Models\Department;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\Permission;
use App\Models\Record;
use App\Models\Role;
use App\Models\Room;
use App\Models\Section;
use App\Models\Sim;
use App\Models\Specialty;
use App\Models\Station;
use App\Models\Structure;
use App\Models\StudentGroup;
use App\Models\Teacher;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as LaravelFile;
use Yajra\DataTables\Facades\DataTables;

class DataTabelController extends Controller {

    public function users(Request $request) {
        $users = User::where('role_id',2)->get();
        if ($request->ajax()) {
            return DataTables::of($users)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->addColumn('name', function ($user) {
                return $user->fullname;
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('phone', function ($user) {
                return $user->phone?? 'N/A';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($user) use ($request){
                // if ($request->has('trashed') && $request->trashed == 1) {
                //     return '
                //         <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreUser(' . $user->id . ')"><i class="mdi mdi-backup-restore"></i></a>
                //         <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteUser(' . $user->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
                //     ';
                // } else {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editUser(' . $user->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteUser(' . $user->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                // }
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('content.dashboard.users.list');
    }

    public function teachers(Request $request) {
        $query = Teacher::query();

        $teachers = $query->where('department_id',Auth::user()->id)->get();

        $ids = $teachers->pluck('id');
        if($request->ajax()) {
            return DataTables::of($teachers)
            ->editColumn('id', function ($teacher) {
                return (string) $teacher->id;
            })
            ->editColumn('code', function ($teacher) {
                return $teacher->code;
            })
            ->editColumn('department_id', function ($teacher) {
                return $teacher->department->name;
            })
            ->editColumn('first_name', function ($teacher) {
                return $teacher->first_name;
            })
            ->editColumn('last_name', function ($teacher) {
                return $teacher->last_name;
            })
            ->editColumn('email', function ($teacher) {
                return $teacher->email;
            })
            ->editColumn('phone', function ($teacher) {
                return $teacher->phone;
            })
            ->editColumn('max_weekly_hours', function ($teacher) {
                return $teacher->max_weekly_hours;
            })
            ->editColumn('specialization', function ($teacher) {
                return $teacher->specialization;
            })
            ->editColumn('created_at', function ($teacher) {
                return $teacher->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($teacher) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editTeacher(' . $teacher->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteTeacher(' . $teacher->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.teachers.list');
    }

    public function structures(Request $request,$id = null) {
        $query = Structure::query();

        if ($id) {
            $department = Department::find($id);
        } else {
            $department = Department::find(Auth::user()->id);
        }
        
        $structures = $query->get();
        
        $ids = $structures->pluck('id');
        if($request->ajax()) {
            return DataTables::of($structures)
            ->editColumn('id', function ($structure) {
                return (string) $structure->id;
            })
            ->editColumn('code', function ($structure) {
                return $structure->code;
            })
            ->editColumn('name', function ($structure) {
                return $structure->name;
            })
            ->editColumn('type', function ($structure) {
                return $structure->type;
            })
            ->editColumn('capacity', function ($structure) {
                return $structure->capacity;
            })
            ->editColumn('building', function ($structure) {
                return $structure->building;
            })
            ->editColumn('location', function ($structure) {
                return $structure->location;
            })
            ->editColumn('has_projector', function ($structure) {
                return $structure->has_projector ? 'Yes' : 'No';
            })
            ->editColumn('has_computers', function ($structure) {
                return $structure->has_computers ? 'Yes' : 'No';
            })
            ->editColumn('created_at', function ($structure) {
                return $structure->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($structure) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editStructure(' . $structure->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteStructure(' . $structure->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.structures.list')
        ->with('department',$department);
    }

    public function faculties(Request $request) {
        $query = Faculty::query();

        $faculties = $query->get();

        $ids = $faculties->pluck('id');
        if($request->ajax()) {
            return DataTables::of($faculties)
            ->editColumn('id', function ($faculty) {
                return (string) $faculty->id;
            })
            ->editColumn('name', function ($faculty) {
                return $faculty->name;
            })
            ->editColumn('code', function ($faculty) {
                return $faculty->code;
            })
            ->editColumn('name_ar', function ($faculty) {
                return $faculty->name_ar;
            })
            ->editColumn('description', function ($faculty) {
                return $faculty->description;
            })
            ->editColumn('created_at', function ($faculty) {
                return $faculty->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($faculty) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteFaculty(' . $faculty->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewFaculty(' . $faculty->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.faculties.list');
    }

    public function levels(Request $request,$id = null) {
        $query = Level::query();

        $levels = $query->get();

        if ($id) {
            $department = Department::find($id);
        } else {
            $department = Department::find(Auth::user()->id);
        }

        $ids = $levels->pluck('id');

        if($request->ajax()) {
            return DataTables::of($levels)
            ->editColumn('id', function ($level) {
                return (string) $level->id;
            })
            ->editColumn('name', function ($level) {
                return $level->name;
            })
            ->editColumn('name_ar', function ($level) {
                return $level->name_ar;
            })
            ->editColumn('code', function ($level) {
                return $level->code;
            })
            ->editColumn('created_at', function ($level) {
                return $level->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($level) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteLevel(' . $level->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewLevel(' . $level->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.levels.list')
        ->with('department',$department);
    }

    public function level_specialties(Request $request,$id = null) {
        $query = Specialty::query();
        
        $level = Level::find($id);

        $specialties = $query->where('department_id',Auth::user()->id)->where('level_id',$id)->get();

        $ids = $specialties->pluck('id');

        if($request->ajax()) {
            return DataTables::of($specialties)
            ->editColumn('id', function ($specialty) {
                return (string) $specialty->id;
            })
            ->editColumn('level_id', function ($specialty) {
                return $specialty->level->name;
            })
            ->editColumn('department_id', function ($specialty) {
                return $specialty->department->name;
            })
            ->editColumn('name', function ($specialty) {
                return $specialty->name;
            })
            ->editColumn('name_ar', function ($specialty) {
                return $specialty->name_ar;
            })
            ->editColumn('code', function ($specialty) {
                return $specialty->code;
            })
            ->editColumn('created_at', function ($specialty) {
                return $specialty->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($specialty) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteSpecialty(' . $specialty->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewSpecialty(' . $specialty->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }

        return view('content.dashboard.levels.specialties')
        ->with('level',$level);
    }

    public function departments_levels(Request $request,$id) {
        $query = Level::query();

        $levels = $query->get();

        $department = Department::find($id);

        $ids = $levels->pluck('id');
        if($request->ajax()) {
            return DataTables::of($levels)
            ->editColumn('id', function ($level) {
                return (string) $level->id;
            })
            ->editColumn('name', function ($level) {
                return $level->name;
            })
            ->editColumn('code', function ($level) {
                return $level->code;
            })
            ->editColumn('name_ar', function ($level) {
                return $level->name_ar;
            })
            ->editColumn('created_at', function ($level) {
                return $level->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($level) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteLevel(' . $level->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewLevel(' . $level->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.departments.levels')
        ->with('department', $department);
    }

    public function specialty_groups(Request $request,$id) {
        $query = StudentGroup::query();

        $groups = $query->where('specialty_id',$id)->get();

        $specialty = Specialty::find($id);

        $ids = $groups->pluck('id');
        if($request->ajax()) {
            return DataTables::of($groups)
            ->editColumn('id', function ($group) {
                return (string) $group->id;
            })
            ->editColumn('specialty_id', function ($group) {
                return $group->specialty->name;
            })
            ->editColumn('level_id', function ($group) {
                return $group->level->name;
            })
            ->editColumn('name', function ($group) {
                return $group->name;
            })
            ->editColumn('code', function ($group) {
                return $group->code;
            })
            ->editColumn('students_count', function ($group) {
                return $group->students_count;
            })
            ->editColumn('created_at', function ($group) {
                return $group->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($group) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteGroup(' . $group->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        ';
                        // <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewGroup(' . $group->id . ')"><i class="mdi mdi-arrow-right"></i></a>
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.specialties.groups')
        ->with('specialty', $specialty);
    }

    public function specialty_courses(Request $request,$id) {
        $query = Course::query();
        
        $specialty = Specialty::find($id);
        
        $courses = $query->where('specialty_id',$specialty->id)->where('level_id',$specialty->level_id)->get();

        $ids = $courses->pluck('id');
        if($request->ajax()) {
            return DataTables::of($courses)
            ->editColumn('id', function ($course) {
                return (string) $course->id;
            })
            ->editColumn('specialty_id', function ($course) {
                return $course->specialty->name;
            })
            ->editColumn('level_id', function ($course) {
                return $course->level->name;
            })
            ->editColumn('name', function ($course) {
                return $course->name;
            })
            ->editColumn('code', function ($course) {
                return $course->code;
            })
            ->editColumn('type', function ($course) {
                return $course->type;
            })
            ->editColumn('weekly_hours', function ($course) {
                return $course->weekly_hours;
            })
            ->editColumn('coefficient', function ($course) {
                return $course->coefficient;
            })
            ->editColumn('Semestre', function ($course) {
                return $course->Semestre;
            })
            ->editColumn('created_at', function ($course) {
                return $course->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($course) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCourse(' . $course->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        ';
                        // <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewCourse(' . $course->id . ')"><i class="mdi mdi-arrow-right"></i></a>
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.specialties.courses')
        ->with('specialty', $specialty);
    }

    public function faculties_departments(Request $request,$id) {
        $faculty = Faculty::find($id);

        $departments = $faculty->departments();

        $ids = $departments->pluck('id');
        if($request->ajax()) {
            return DataTables::of($departments)
            ->editColumn('id', function ($department) {
                return (string) $department->id;
            })
            ->editColumn('name', function ($department) {
                return $department->name;
            })
            ->editColumn('email', function ($department) {
                return $department->email;
            })
            ->editColumn('code', function ($department) {
                return $department->code;
            })
            ->editColumn('name_ar', function ($department) {
                return $department->name_ar;
            })
            ->editColumn('description', function ($department) {
                return $department->description;
            })
            ->editColumn('created_at', function ($department) {
                return $department->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($department) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteDepartment(' . $department->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewDepartment(' . $department->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.faculties.departments')
        ->with('faculty', $faculty);
    }

    public function departments_teachers(Request $request,$id) {
        $department = Department::find($id);

        $teachers = $department->teachers();

        $ids = $teachers->pluck('id');
        if($request->ajax()) {
            return DataTables::of($teachers)
            ->editColumn('id', function ($teacher) {
                return (string) $teacher->id;
            })
            ->editColumn('name', function ($teacher) {
                return $teacher->name;
            })
            ->editColumn('email', function ($department) {
                return $department->email;
            })
            ->editColumn('code', function ($teacher) {
                return $teacher->code;
            })
            ->editColumn('name_ar', function ($teacher) {
                return $teacher->name_ar;
            })
            ->editColumn('description', function ($teacher) {
                return $teacher->description;
            })
            ->editColumn('created_at', function ($teacher) {
                return $teacher->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($teacher) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteDepartment(' . $teacher->id . ')"><i class="mdi mdi-trash-can"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="viewDepartment(' . $teacher->id . ')"><i class="mdi mdi-arrow-right"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.departments.teachers')
        ->with('department', $department);
    }
    
    public function models(Request $request) {
        $query = CourseModel::query();

        $models = $query->get();

        $ids = $models->pluck('id');
        if($request->ajax()) {
            return DataTables::of($models)
            ->editColumn('id', function ($course_model) {
                return (string) $course_model->id;
            })
            ->editColumn('name', function ($course_model) {
                return $course_model->name;
            })
            ->editColumn('created_at', function ($course_model) {
                return $course_model->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($course_model) use ($request) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editModel(' . $course_model->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteModel(' . $course_model->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['status','actions','file'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.course-models.list');
    }

    public function sections(Request $request) {
        $query = Section::query();

        $sections = $query->get();

        $ids = $sections->pluck('id');
        if($request->ajax()) {
            return DataTables::of($sections)
            ->editColumn('id', function ($section) {
                return (string) $section->id;
            })
            ->editColumn('name', function ($section) {
                return $section->name;
            })
            ->editColumn('created_at', function ($section) {
                return $section->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($section) use ($request) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editSection(' . $section->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteSection(' . $section->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['status','actions','file'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.sections.list');
    }

    public function languages(Request $request) {
        $languages = [];
        foreach (config('language') as $locale => $language) {
            $languages[] = $locale;
        }

        if ($request->ajax()) {
            $words = [];

            foreach ($languages as $lang) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (LaravelFile::exists($jsonPath)) {
                    $translations = json_decode(LaravelFile::get($jsonPath), true);

                    foreach ($translations as $key => $translation) {
                        $words[$key][$lang] = $translation;
                    }
                }
            }

            $words = collect($words)->map(function ($translations, $word) use ($languages) {
                $row = ['word' => $word];
                foreach ($languages as $lang) {
                    $row[$lang] = $translations[$lang] ?? __('Not available');
                }
                return $row;
            });

            $id = 0;
            return DataTables::of($words)
            ->addColumn('id', function ($word) use (&$id) {
                return (string) ++$id;
            })
            ->addColumn('word', function ($word){
                return $word['word'];
            })
            ->addColumn('actions', function ($word) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.languages.index')
            ->with('languages', $languages);
    }

    public function roles(Request $request) {
        $roles = Role::all();

        if ($request->ajax()) {
            return DataTables::of($roles)
            ->editColumn('id', function ($role) {
                return $role->id;
            })
            ->editColumn('name', function ($role) {
                return $role->name;
            })
            ->editColumn('guard_name', function ($role) {
                return $role->guard_name;
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($role) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editRole(' . $role->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteRole(' . $role->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.roles.index');
    }

    public function permissions(Request $request) {
        $permissions = Permission::all();

        if ($request->ajax()) {
            return DataTables::of($permissions)
            ->editColumn('id', function ($permission) {
                return $permission->id;
            })
            ->editColumn('name', function ($permission) {
                return $permission->name;
            })
            ->editColumn('guard_name', function ($permission) {
                return $permission->guard_name;
            })
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($permission) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editPermission(' . $permission->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deletePermission(' . $permission->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.permissions.index');
    }

}
