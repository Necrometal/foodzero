const url = process.env.MIX_APP_URL + '/api/admin/'

function concatUrl(api) {
    return url + api;
}

export const login = concatUrl('login')
export const logout = concatUrl('logout')
export const checkAuth = concatUrl('check-auth')

export const listCategorie = concatUrl('categorie/list-all')
export const createCategorie = concatUrl('categorie/create')
export const updateCategorie = concatUrl('categorie/update/')
export const deleteCategorie = concatUrl('categorie/delete/')

export const listMenu= concatUrl('menus/list-all')
export const createMenu = concatUrl('menus/create')
export const updateMenu = concatUrl('menus/update/')
export const deleteMenu = concatUrl('menus/delete/')

export const listReservation = concatUrl('reservation/list-all')

export const listSubscription = concatUrl('subscription/list-all')