<x-layout :title="$title">
    <!-- HTML structure with added classes -->
    <div class="scenes-container">
        <h2>La liste des scènes</h2>
        <h4>Filtrage par équipe ou récent</h4>
        <form id="filterForm" action="{{ route('scenes.index') }}" method="get">
            <select name="filterType" id="filterType">
                <option value="equipe" @if($filterType == 'equipe') selected @endif>Filtrer par équipe</option>
                <option value="recent" @if($filterType == 'recent') selected @endif>Filtrer par plus récent</option>
                <option value="note" @if($filterType == 'note') selected @endif>Filtrer par mieux notées</option>

            </select>

            <div id="equipeFilter" class="filter-section" @if($filterType != 'equipe') style="display:none;" @endif>
                <select name="equipe">
                    <option value="All" @if($equipe == 'All') selected @endif>--Toutes les équipes--</option>
                    @foreach($nb as $n)
                        <option value="{{$n}}" @if($equipe == $n) selected @endif>{{$n}}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="OK">
        </form>

        @if(!empty($scenes))
            <table class="scenes-table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Équipe</th>
                    <th>Date d'ajout</th>
                    <th>Note moyenne</th>
                    <th>Vignette</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scenes as $scene)
                    <tr>
                        <td>{{$scene->nom}}</td>
                        <td>{{$scene->equipe}}</td>
                        <td>{{$scene->date_ajout}}</td>
                        <td>{{$scene->avg_note}}</td>
                        <td>
                            <img
                                src="{{$scene->lien_vignette}}"
                                alt="La vignette"
                                class="thumbnail enlarge"
                                onclick="openModal('{{$scene->lien_vignette}}')"
                            >
                        </td>
                        <td>
                            <a href="{{route('scenes.show', $scene->id)}}"><button class="action-button view-button">Visualiser</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Modal container -->
    <div id="modal-container" class="modal-container">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <img id="modal-image" class="modal-content">
    </div>
    <script>
        function openModal(imageSrc) {
            var modal = document.getElementById('modal-container');
            var modalImage = document.getElementById('modal-image');

            modal.style.display = 'block';
            modalImage.src = imageSrc;
        }

        function closeModal() {
            var modal = document.getElementById('modal-container');
            modal.style.display = 'none';
        }
    </script>
    <script>
        // Ajoutez cet événement change pour détecter le changement dans le choix du filtre
        document.getElementById('filterType').addEventListener('change', function() {
            var equipeFilter = document.getElementById('equipeFilter');

            if (this.value === 'equipe') {
                equipeFilter.style.display = 'block';
            } else if (this.value === 'recent' || this.value === 'note') {
                equipeFilter.style.display = 'none';
            }
        });
    </script>


</x-layout>
