export function authGuard(req, res, next) {
  var isAuthenticated= false;
  if(localStorage.getItem('token'))
    isAuthenticated = true;
  else
    isAuthenticated= false;
  if(isAuthenticated) 
  {
    next(); 
  } 
  else
  {
    next('/login'); 
  }
}
export function redirectIfAuthenticated(req, res, next) {
    var isAuthenticated= false;
    if(localStorage.getItem('token'))
      isAuthenticated = true;
    else
      isAuthenticated= false;
    if(!isAuthenticated) 
    {
      next(); 
    } 
    else
    {
      next('/'); 
    }
}

export function getBreadCrumbList(ignore = null) {
  var here = location.href.replace(/(\?.*)$/, '').split('/').slice(3);
  if (ignore != null) {
    const index = here.indexOf(ignore);
    here[index] = 'dashboard'; // Replace with dashboard
  }
 
  return Array.from(new Set(here));
}