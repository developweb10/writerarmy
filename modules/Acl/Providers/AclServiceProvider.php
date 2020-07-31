<?php namespace Modules\Acl\Providers;

use Config;
use Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Modules\Acl\Entities\Permission;

class AclServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the application events.
	 *
	 * @return void
	 */
	public function boot(GateContract $gate)
	{
		$this->registerTranslations();
		$this->registerConfig();
		$this->registerViews();

		$this->registerPermissions($gate);
	}

  protected function registerPermissions($gate)
  {
    if(Schema::hasTable(\Config::get('acl.permission_table'))) {
      foreach($this->getPermissions() as $permission) {
          $gate->define($permission->slug, function($user) use($permission)
          {
              return $user->hasRole($permission->roles);
          });
      }
    }
  }

  protected function getPermissions() {
      return Permission::with('roles')->get();
  }
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Register config.
	 *
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('acl.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'acl'
		);
	}

	/**
	 * Register views.
	 *
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/acl');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path) {
			return $path . '/modules/acl';
		}, \Config::get('view.paths')), [$sourcePath]), 'acl');
	}

	/**
	 * Register translations.
	 *
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/acl');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'acl');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'acl');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
