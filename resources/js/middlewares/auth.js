import { useUserService } from '@services/userservice'

export function useAuth(){
    const { checkAuthValidity } = useUserService()
    
    async function checkIt(){
        let valide = await checkAuthValidity()
        if(!valide) return 0; // error
        if(typeof valide == 'string') return 1; // not valide
        return 2; // valide
    }

    return checkIt
}