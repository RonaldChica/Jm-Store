<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;

class CreateRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates system roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions = [
            'list topic',
            'create topic',
            'edit topic',
            'delete topic',
            'list question',
            'create question',
            'edit question',
            'delete question',
            'list user',
            'create user',
            'edit user',
            'delete user'
        ];

        foreach ($permissions as $permission) {
            try {
                Permission::create(['name' => $permission]);
            } catch (PermissionAlreadyExists $exception) {
                $this->error($exception->getMessage());
            }
        }

        $roles = [
            'super',
            'admin',
            'writer',
            'user'
        ];

        foreach ($roles as $role) {
            try {
                Role::create(['name' => $role]);
            } catch (RoleAlreadyExists $exception) {
                $this->error($exception->getMessage());
            }
        }

        $permissions = Permission::pluck('id', 'id')->all();
        $role = Role::findByName('super');
        $role->syncPermissions($permissions);

        $user = User::take(1)->first();
        $user->assignRole([$role->id]);
        $user->save();

        return 0;
    }
}
